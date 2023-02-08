#!/bin/bash

docker-compose down
docker-compose build
docker-compose up -d

clear
echo -n "テーマディレクトリ名を入力: "
read DIR
if [ -z $DIR ]; then
  exit 0
fi

mv ./my-theme-template ./html/wp-content/themes/$DIR
echo
echo "Make theme file."
echo "-> html/wp-content/themes/$DIR"

rm -rf .git
rm .gitignore
echo
echo "Deleted current git files."
echo "-> .git/ .gitignore"

echo "php_value upload_max_filesize 1024M" >> ./html/.htaccess
echo "php_value post_max_size 1024M" >> ./html/.htaccess
echo "php_value memory_limit 256M" >> ./html/.htaccess
echo "php_value max_execution_time 300" >> ./html/.htaccess
echo "php_value max_input_time 300" >> ./html/.htaccess

cd ./html/wp-content/themes/$DIR
git init

echo
echo "===================================="
echo "setup completed."
echo
echo "next step"
echo "$ cd ./html/wp-content/themes/$DIR"
echo '$ git add .'
echo '$ git commit -m "first commit"'
echo '$ git remote add origin <URL>'
echo '$ git push -uf origin main'