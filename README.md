# WordPress自作テーマ開発用テンプレート（Docker環境）
WordPress案件用のセットアップテンプレート


# Installation
## 1. リポジトリの作成・クローン
1. [テンプレートリポジトリ](https://github.com/ucan-lab/docker-laravel/generate)からリポジトリを作成
2. Git clone & change directory

## 2. イメージ・コンテナの作成
```bash
docker-compose up -d
```

### WordPressコンテナ
`localhost:10090`  
ユーザ名: 

### phpMyAdminコンテナ
`localhost:10099`  

ユーザ名: user  
パスワード: password  

## 3. WordPressのセットアップ
`localhost:10090`にアクセス  
ユーザ名、パスワード等を設定してWordPressをインストールする

## 4. 雛形テーマファイルの移行
`html/wp-content/themes/` に `my-theme`ディレクトリを移動する
```bash
mv ./my-theme-template ./html/wp-content/themes/[自作テーマ名]
```

## 5. 自作テーマディレクトリのシンボリックリンクを作成 （任意）
```bash
ln -s ./html/wp-content/themes/[自作テーマ名]/[自作テーマ名]
```


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
