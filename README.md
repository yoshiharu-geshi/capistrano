__デプロイ管理ツール2選__

# capistrano

+ 一般的に広く使われている技術
+ WindowsサーバーへのデプロイをWindowsServer2019で検証したが少し微妙な感じがします

## 公式ドキュメント

+ https://capistranorb.com/
+ https://github.com/capistrano/capistrano

## WindowsServer用

+ https://github.com/SciMed/capistrano-windows-server

## How To USE

```
bundle exec cap production deploy -> 全部にデプロイ
ROLES=linux01 bundle exec cap production deploy -> linux01だけにデプロイ
ROLES=linux bundle exec cap production deploy -> linuxだけにデプロイ
```

### USE の詳細

+ production
   + 通常はここを {environment} と表現している
   + `config/deploy/{environment}.rb` の設定を使ってくださいという意味
+ ROLES
   + 設定に書かれているROLEだけを動作させる

## How To Setting

+ config/deploy.rb
   + 全環境の共通設定
+ config/deploy/production.rb
   + 特定の環境のみの設定。サーバーのIPなどは通常はこちら

# deployer

+ PHPで動作するデプロイツール
+ 既に用意されてるコマンドも豊富だが、自由自在にカスタマイズも出来る
+ WindowsServer用はなかったので、少しカスタマイズしてみました

## 公式ドキュメント

+ https://deployer.org/

## How To Install

```
$ composer require deployer/deployer --dev
$ composer require deployer/recipes --dev
$ ./vendor/bin/dep init
```

## How To USE

```
$ ./vendor/bin/dep deploy windows
$ ./vendor/bin/dep deploy windows --roles=first_apps
```

### USE の詳細

+ windows
   + stage の指定を行う。productionのみと想定し、windowsと分かりやすくした
+ `--roles`
   + `stage` が `windows` の中でも、一台だけデプロイしたい時に使える

## How To Setting

+ deploy.php
   + 24行目付近のHOSTSを設定する
