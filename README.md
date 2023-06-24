# WordPress開発用テンプレート（Docker環境）
WordPress用の初期セットアップテンプレート

# Installation
```bash
git clone https://github.com/opipi406/wp-theme-template.git <プロジェクト名>
```

## イメージ・コンテナの作成
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

## WordPressのセットアップ
`localhost:8080`にアクセス  
ユーザ名、パスワード等を設定してWordPressをインストールする

## .htaccessにアップロード制限解除の設定を追記
```bash
echo "php_value upload_max_filesize 1024M" >> html/.htaccess \
  && echo "php_value post_max_size 1024M" >> html/.htaccess \
  && echo "php_value memory_limit 256M" >> html/.htaccess \
  && echo "php_value max_execution_time 300" >> html/.htaccess \
  && echo "php_value max_input_time 300" >> html/.htaccess
```

## 雛形テーマファイルの移行
`html/wp-content/themes/` に `my-theme`ディレクトリを移動する
```bash
mv ./my-theme ./html/wp-content/themes/<自作テーマ名>
```

## 後処理、テーマディレクトリをgit管理下に置く
```bash
rm -rf .git .gitignore
cd src
git init
```

## コミット
```bash
git add .
git commit -m "first commit"
git remote add origin <URL>
git push -u origin main
```

### Shellが実行できる環境であれば、上記のstep1〜6までを`setup.sh`を実行することで自動化できます。

# Usage
## gulp, webpack実行環境の準備
```bash
npm install
```
## Sassのwatcher起動 (sass, autoprefixer)
```bash
npm run dev
```
## browser-syncを使用してwatcher起動
```bash
npm run dev:sync
```
## Utilityクラス定義CSSファイルの生成
```bash
npm run build:utils
```
## Utilityクラス定義CSSファイルの最適化
```bash
npm run purge:utils
```
## webpackのwatcher起動
```bash
npm run dev:js
```
## JavaScriptファイルをscript.jsにバンドル
```bash
npm run build:js
```

# 実行環境
|||
|-|-|
|OS|Mac OS|
|node|v16.17.0|

# Tips

## 環境移行についてのメモ（All-in-One WP Migration）
[サーバー上のWordPressサイトの画像や投稿データを超簡単にローカルにコピーする方法](https://yosiakatsuki.net/blog/copy-site-data-to-local/)

### アップロードサイズの変更
```bash
php_value upload_max_filesize 1024M
php_value post_max_size 1024M
php_value memory_limit 256M
php_value max_execution_time 300
php_value max_input_time 300
```

## その他有用な記事

[Dockerでコンテナ起動後に「Error establishing a database connection 」と出てデータベースに接続できない時の対処法：Warning: mysqli_real_connect(): php_network_getaddresses: getaddrinfo failed:](https://prograshi.com/platform/docker/dokcer-wp-db-connection-error/)
