# config valid for current version and patch releases of Capistrano
lock "~> 3.11.0"

# アプリケーション名（任意）
set :application, "my_app_name"

# github のURL
set :repo_url, "git@github.com:yoshiharu-geshi/capistrano.git"

# リリースするブランチ。 'ask' にすることで、実行時にも設定可能
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# リリース先の場所
# set :deploy_to, "/var/www/my_app_name"

# シンボリックリンクにするファイル
append :linked_files, "config/database.yml"

# シンボリックリンクにするディレクトリ
append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"

# デプロイ先でのソースのバージョンの保持数
set :keep_releases, 5

set :deploy_to, "/cygdrive/c/Apps/application         " # Deploy to C:\rails_apps\#{application}
set :mongrel_instances, (1..3)                          # Create 3 mongrel instances
set :mongrel_instance_prefix, 'mongrel_'                # named mongrel_{1..3}
set :base_port, 8000                                    # on ports 8000, 8001, 8002

# コマンド実行時にsudoをつけるか
set :use_sudo, false
