# capistrano公式

+ https://capistranorb.com/
+ https://github.com/capistrano/capistrano

# How To USE

```
bundle exec cap production deploy -> 全部にデプロイ
ROLES=linux01 bundle exec cap production deploy -> linux01だけにデプロイ
ROLES=linux bundle exec cap production deploy -> linuxだけにデプロイ
```

## USE の詳細

+ production
   + 通常はここを {environment} と表現している
   + `config/deploy/{environment}.rb` の設定を使ってくださいという意味
+ ROLES
   + 設定に書かれているROLEだけを動作させる

# How To Setting

+ config/deploy.rb
   + 全環境の共通設定
+ config/deploy/production.rb
   + 特定の環境のみの設定。サーバーのIPなどは通常はこちら

# デプロイについて

+ Linux環境だけならこれでいける

+ Windowsサーバーへのデプロイは未検証
   + https://github.com/SciMed/capistrano-windows-server
