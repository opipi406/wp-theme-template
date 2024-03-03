# WordPress開発用テンプレート（Docker環境）
WordPress用の初期セットアップテンプレート

# Installation
> Shellが実行できない環境の場合は、`Installation(command)`の手順を参照してください。

```bash
git clone https://github.com/opipi406/wp-theme-template.git <プロジェクト名>
```

### WordPressのセットアップ ~ テーマファイル生成
```bash
bash wp-template.sh init
```

### テーマディレクトリのGitリポジトリ化
```bash
rm -rf .git .gitignore
cd html/wp-content/themes/<自作テーマ名> && git init

git add -A
git commit -m "first commit"
git remote add origin <URL>
git push -u origin main
```

### WordPressコアファイルの初期セットアップ
```bash
bash wp-template.sh setup
```

# Installation(command)
```bash
git clone https://github.com/opipi406/wp-theme-template.git <プロジェクト名>
```

### イメージ・コンテナの作成
```bash
docker-compose up -d
```
### WordPressのセットアップ
`localhost:8080`にアクセス  
ユーザ名、パスワード等を設定してWordPressをインストールする

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

### テーマディレクトリのGitリポジトリ化
```bash
rm -rf .git .gitignore
cd html/wp-content/themes/<自作テーマ名> && git init

git add -A
git commit -m "first commit"
git remote add origin <URL>
git push -u origin main
```

# Usage
### 環境
|container|port|
|-|-|
|WordPressコンテナ|localhost:8080|
|phpMyAdminコンテナ|localhost:8089|

- DBアクセス情報
  - ユーザ名: user
  - パスワード: qweqwe

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
- Note.js `v18.17.1`
