require 'capistrano/ext/multistage'
load './config/local_config'

set :application, "code2040"
set :domains, ["default"]
set :local_domain, "code2040.test"

set :app_root, "wordpress"
set :wp_local, "cd #{local_repo_path}/#{app_root} ; /usr/bin/wp"

set :stages, %w(local staging)

set :scm,             :git
set :repository,      "git@github.com:tigerlilyinc/code2040.git"
set :keep_releases,   4

set :normalize_asset_timestamps, false

set(:db_root_pass) { Capistrano::CLI.password_prompt("Production Root MySQL password: ") }
set(:db_pass) { random_password }

set :use_sudo,        false
default_run_options[:pty] = true


namespace :deploy do
  desc "Prepares one or more servers for deployment."
  task :setup, :roles => :web, :except => { :no_release => true } do
    dirs = [deploy_to, releases_path, shared_path]
    domains.each do |domain|
      dirs += [shared_path + "/#{domain}/files"]
      dirs += [shared_path + "/#{domain}/files/uploads"]
      dirs += [shared_path + "/#{domain}/files/cache"]
    end
    dirs += %w(system).map { |d| File.join(shared_path, d) }
    run "mkdir -m 0775 -p #{dirs.join(' ')}"
    run "chmod 2775 #{shared_path}/*/files"
    run "chmod 2775 #{shared_path}/*/files/uploads"
    run "chmod 2775 #{shared_path}/*/files/cache"
    run "chgrp #{group} #{shared_path}/*/files"
    run "chgrp #{group} #{shared_path}/*/files/*"
  end

  desc "Create local local_config.php in shared/config"
  task :create_settings_php, :roles => :web do
    domains.each do |domain|
        configuration = <<-EOF
<?php

  define('DB_NAME', '#{short_name(domain)}');

  /** MySQL database username */
  define('DB_USER', '#{tiny_name(domain)}');

  /** MySQL database password */
  define('DB_PASSWORD', '#{db_pass}');

  /** MySQL hostname */
  define('DB_HOST', 'localhost');

  /** Database Charset to use in creating database tables. */
  define('DB_CHARSET', 'utf8');

  /** The Database Collate type. Don't change this if in doubt. */
  define('DB_COLLATE', '');
EOF

      put configuration, "#{deploy_to}/#{shared_dir}/#{domain}/local-config.php"
    end
  end

  desc "link file dirs and the local_settings.php to the shared copy"
  task :symlink_files, :roles => :web do
    domains.each do |domain|
      run "ln -nfs #{deploy_to}/#{shared_dir}/#{domain}/local-config.php #{release_path}/#{app_root}/local-config.php"
      run "ln -nfs #{deploy_to}/#{shared_dir}/#{domain}/files/uploads #{release_path}/#{app_root}/wp-content/uploads"
      run "ln -nfs #{deploy_to}/#{shared_dir}/#{domain}/files/cache #{release_path}/#{app_root}/wp-content/cache"
    end
  end

  task :finalize_update, :except => { :no_release => true } do
    run "chmod -R g+w #{release_path}"
    run "chmod 644 #{release_path}/#{app_root}/wp-config.php"
    run "chmod 644 #{release_path}/#{app_root}/join_list.php"
    run "chmod 644 #{release_path}/#{app_root}/send_contact_form.php"
    run "cp #{release_path}/#{app_root}/.htaccess-production #{release_path}/#{app_root}/.htaccess"
    run "chmod 644 #{release_path}/#{app_root}/.htaccess"
  end

  after "deploy:setup", "deploy:create_settings_php", "db:create"
  after "deploy:update_code", "deploy:symlink_files"
  after "deploy", "deploy:cleanup"
end

namespace :db do
  desc "Download a backup of the database(s) from the given stage."
  task :down, :roles => :db, :only => { :primary => true } do
    domains.each do |domain|
      current_host = capture("echo $CAPISTRANO:HOST$").strip
      filename = "#{application}_#{stage}.sql"
      temp = "/tmp/#{release_name}_#{filename}"
      run "touch #{temp} && chmod 600 #{temp}"
      run_locally "mkdir -p db"
      run "#{wp} db export --file=#{temp} && cd -"
      download("#{temp}", "db/#{filename}", :via=> :scp)
      search = "#{current_host}"
      replace = local_domain
      puts "searching (#{search}) and replacing (#{replace}) domain information"
      run_locally "sed -e 's/#{search}/#{replace}/g' -i .bak db/#{filename}"
      run "rm #{temp}"
    end
  end

  desc "Download and apply a backup of the database(s) from the given stage."
  task :pull, :roles => :db, :only => { :primary => true } do
    domains.each do |domain|
      filename = "#{application}_#{stage}.sql"
      run_locally "#{wp_local} db import --file=../db/#{filename}"
    end
  end

  desc "Upload database(s) to the given stage."
  task :push, :roles => :db, :only => { :primary => true } do
    domains.each do |domain|
      current_host = capture("echo $CAPISTRANO:HOST$").strip
      filename = "#{application}_local.sql"
      temp = "/tmp/#{release_name}_#{filename}"
      run "touch #{temp} && chmod 600 #{temp}"
      replace = "#{current_host}"
      search = local_domain
      puts "searching (#{search}) and replacing (#{replace}) domain information"
      run_locally "sed -e 's/#{search}/#{replace}/g' -i .bak db/#{filename}"
      upload("db/#{filename}", "#{temp}", :via=> :scp)
      run "cd #{deploy_to}/current/#{app_root} && #{wp} db import --file=#{temp}"
      #run "rm #{temp}"
    end
  end

  desc "Create database"
  task :create, :roles => :db, :only => { :primary => true } do
    # Create and gront privs to the new db user
    domains.each do |domain|
      create_sql = "CREATE DATABASE IF NOT EXISTS \\\`#{short_name(domain)}\\\` ;
                    GRANT ALL ON \\\`#{short_name(domain)}\\\`.* TO '#{tiny_name(domain)}'@'localhost' IDENTIFIED BY '#{db_pass}';
                    FLUSH PRIVILEGES;"
      run "mysql -u root -p#{db_root_pass} -e \"#{create_sql}\""
      puts "Using pass: #{db_pass}"
    end
  end

  before "db:pull", "db:down"
end

namespace :files do
  desc "Download a backup of the wp-content uploads directory from the given stage."
  task :pull, :roles => :web do
    run_locally("rm -rf #{app_root}/wp-content/uploads")
    domains.each do |domain|
      run_locally("scp -r -i #{ssh_options[:keys][0]} #{ssh_options[:user]}@#{find_servers(:roles => :web).first.host}:#{deploy_to}/#{shared_dir}/#{domain}/files/uploads #{app_root}/wp-content/")
    end
  end

  desc "Push a backup of the wp-content uploads directory to the given stage."
  task :push, :roles => :web do
    domains.each do |domain|
      run_locally("scp -r -i #{ssh_options[:keys][0]} #{app_root}/wp-content/uploads #{ssh_options[:user]}@#{find_servers(:roles => :web).first.host}:#{deploy_to}/#{shared_dir}/#{domain}/files/")
    end
  end
end

def short_name(domain=nil)
  return "#{application}_#{stage}_#{domain}".gsub('.', '_')[0..63] if domain && domain != 'default'
  return "#{application}_#{stage}".gsub('.', '_')[0..63]
end

def tiny_name(domain=nil)
  return "#{application[0..5]}_#{stage.to_s[0..2]}_#{domain[0..4]}".gsub('.', '_') if domain && domain != 'default'
  return "#{application[0..11]}_#{stage.to_s[0..2]}".gsub('.', '_')
end

def random_password(size = 16)
  chars = (('A'..'Z').to_a + ('a'..'z').to_a + ('0'..'9').to_a) - %w(i o 0 1 l 0)
  (1..size).collect{|a| chars[rand(chars.size)] }.join
end

