role :web, "code2040.test"
role :db, "code2040.test", :primary => true

set :wp, "cd #{local_repo_path}/#{app_root} ; /usr/bin/wp"

