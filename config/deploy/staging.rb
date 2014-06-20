set :deploy_to, "/home/ubuntu/code2040-cms-staging"

role :web, "code2040.org"
role :db, "code2040.org", :primary => true

set :wp, "cd #{current_path}/#{app_root} ; /usr/bin/wp"

ssh_options[:user] = "ubuntu"
ssh_options[:keys] = ["#{ENV['HOME']}/.ssh/code2040_tigerlily.pem"]
ssh_options[:forward_agent] = true

set :user,            "ubuntu"
set :group,           "www-data"

