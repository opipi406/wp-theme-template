# WordPress開発用テンプレート（Docker環境）
WordPress用の初期セットアップテンプレート

# Installation
## 1. リポジトリの作成・クローン
1. [テンプレートリポジトリ](https://github.com/opipi406/wp-theme-template/generate)からリポジトリを作成
2. Git clone & change directory

## 2. イメージ・コンテナの作成
```bash
docker-compose up -d
```

WordPressコンテナ : `localhost:10090`  
phpMyAdminコンテナ : `localhost:10099`  

MySQLに「user」のアカウントが無い場合、`localhost:10099`に接続して以下のユーザーアカウントを作成  

ユーザ名: user  
パスワード: qweqwe  

## 3. WordPressのセットアップ
`localhost:10090`にアクセス  
ユーザ名、パスワード等を設定してWordPressをインストールする

## 4. 雛形テーマファイルの移行
`html/wp-content/themes/` に `my-theme`ディレクトリを移動する
```bash
mv ./my-theme-template ./html/wp-content/themes/<自作テーマ名>
```

## 5. 自作テーマディレクトリのシンボリックリンクを作成 （任意）
```bash
ln -s ./html/wp-content/themes/<自作テーマ名> <自作テーマ名>
```

## 6. 後処理、テーマディレクトリをgit管理下に置く
```bash
rm -rf .git .gitignore
```
```bash
cd ./html/wp-content/themes/<自作テーマ名>
git init
```

## 7. first commit
```bash
git add .
git commit -m "first commit"
git remote add origin <URL>
git push -uf origin main
```

# Usage
## gulp, webpack実行環境の準備
```bash
npm ci
```
## 開発サーバー起動 (sass, autoprefixer, browser-sync)
```bash
npm run dev
```
## browser-syncを使わずにsassコンパイル監視環境を構築
```bash
npm run dev:nosync
```
## Utilityクラス定義ファイルの生成
```bash
npm run build:utils
```
## Utilityクラス定義ファイルの最適化
```bash
npm run purge:utils
```
## JavaScriptファイルをbundle.jsにバンドル
```bash
npm run build:webpack
```

# 実行環境
|||
|-|-|
|OS|Mac OS|
|node|v16.17.0|

# Note

## 環境移行についてのメモ（All-in-One WP Migration）
[サーバー上のWordPressサイトの画像や投稿データを超簡単にローカルにコピーする方法](https://yosiakatsuki.net/blog/copy-site-data-to-local/)

### データベースの置換設定 (末尾の"/"は消す)
```
https://hogehoge.com/wp-huga
http://localhost:10090
```

### アップロードサイズの変更
```
php_value upload_max_filesize 512M
php_value post_max_size 512M
php_value memory_limit 256M
php_value max_execution_time 300
php_value max_input_time 300
```

## その他有用な記事

[Dockerでコンテナ起動後に「Error establishing a database connection 」と出てデータベースに接続できない時の対処法：Warning: mysqli_real_connect(): php_network_getaddresses: getaddrinfo failed:](https://prograshi.com/platform/docker/dokcer-wp-db-connection-error/)
