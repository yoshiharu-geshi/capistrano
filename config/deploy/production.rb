# 本番環境の設定

server "windows01.example.com", user: "deploy", roles: %w{app windows}, my_property: :my_value
server "linux01.example.com", user: "deploy", roles: %w{app linux linux01}, other_property: :other_value
server "linux02.example.com", user: "deploy", roles: %w{app linux }, other_property: :other_value

# 共通SSH設定
set :ssh_options, {
  keys: %w(/home/rlisowski/.ssh/id_rsa),
  forward_agent: false,
  auth_methods: %w(password)
}

# サーバー特化のSSH設定
server "example.com",
  user: "user_name",
  roles: %w{web app},
  ssh_options: {
    user: "user_name", # overrides user setting above
    keys: %w(/home/user_name/.ssh/id_rsa),
    forward_agent: false,
    auth_methods: %w(publickey password)
    # password: "please use keys"
  }
