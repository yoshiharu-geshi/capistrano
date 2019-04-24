# config valid for current version and patch releases of Capistrano
lock "~> 3.11.0"

# アプリケーション名（任意）
set :application, "my_app_name"

# github のURL
set :repo_url, "git@example.com:me/my_repo.git"

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

# コマンド実行時にsudoをつけるか
set :use_sudo, false


# How To USE
# bundle exec cap production deploy -> 全部にデプロイ
# ROLES=linux01 bundle exec cap production deploy -> linux01だけにデプロイ
# ROLES=linux bundle exec cap production deploy -> linuxだけにデプロイ
