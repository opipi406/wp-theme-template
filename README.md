# WordPress開発用テンプレート（Docker環境）
WordPress用の初期セットアップテンプレート

# Installation
```bash
git clone https://github.com/opipi406/wp-theme-template.git <プロジェクト名>
```

### イメージ・コンテナの作成
```bash
docker-compose up -d
```
|container|port|
|-|-|
|WordPressコンテナ|localhost:8080|
|phpMyAdminコンテナ|localhost:8089|

MySQLに「user」のアカウントが無い場合、`localhost:8089`に接続して以下のユーザーアカウントを作成  

ユーザ名: user  
パスワード: qweqwe  

### WordPressのセットアップ
`localhost:8080`にアクセス  
ユーザ名、パスワード等を設定してWordPressをインストールする

> Shellが実行できる環境であれば、以降に記載している `.htaccessにアップロード制限解除の設定を追記` から `後処理、テーマディレクトリをgit管理下に置く` までを `bash wp-template.sh init` で自動化できます。

### .htaccessにアップロード制限解除の設定を追記
```bash
cd <project-root>
```
```bash
echo "" >> html/.htaccess \
&& echo "php_value upload_max_filesize 1024M" >> html/.htaccess \
&& echo "php_value post_max_size 1024M" >> html/.htaccess \
&& echo "php_value memory_limit 256M" >> html/.htaccess \
&& echo "php_value max_execution_time 300" >> html/.htaccess \
&& echo "php_value max_input_time 300" >> html/.htaccess
```

### 雛形テーマファイルの移行
`html/wp-content/themes/` に `my-theme`ディレクトリを移動する
```bash
mv ./my-theme ./html/wp-content/themes/<自作テーマ名>
```

### 後処理、テーマディレクトリをgit管理下に置く
```bash
rm -rf .git .gitignore
cd html/wp-content/themes/<自作テーマ名> && git init
```

### コミット
```bash
git add -A
git commit -m "first commit"
git remote add origin <URL>
git push -u origin main
```

# Usage
### デプロイ
`wp-template.sh deploy` を実行すると、`.deploy.conf` に記載されたリモートサーバーにテーマファイルがコピー（デプロイ）される。

`wp-template.sh deploy [--develop | --dev]` を実行すると、開発環境用（`.deploy.develop.conf`）の設定でデプロイが可能。

#### 設定項目
- `SSH_HOST_ALIAS`：SSH接続時のホスト名のエイリアス
- `DEPLOY_PATH`：デプロイ先のサーバーのディレクトリパス（基本は絶対パスでテーマディレクトリを指定）

# Tips
[サーバー上のWordPressサイトの画像や投稿データを超簡単にローカルにコピーする方法](https://yosiakatsuki.net/blog/copy-site-data-to-local/)

[Dockerでコンテナ起動後に「Error establishing a database connection 」と出てデータベースに接続できない時の対処法：Warning: mysqli_real_connect(): php_network_getaddresses: getaddrinfo failed:](https://prograshi.com/platform/docker/dokcer-wp-db-connection-error/)

# Requirement
|||
|-|-|
|OS|Mac OS|
|node|v18.17.1|
