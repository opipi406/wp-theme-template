#!/usr/bin/env bash

UNAMEOUT="$(uname -s)"
BASE_DIR=$(
    cd $(dirname $0)
    pwd
)

# Verify operating system is supported...
case "${UNAMEOUT}" in
Linux*) MACHINE=linux ;;
Darwin*) MACHINE=mac ;;
*) MACHINE="UNKNOWN" ;;
esac

if [ "$MACHINE" == "UNKNOWN" ]; then
    exit 1
fi

# Determine if stdout is a terminal...
if test -t 1; then
    # Determine if colors are supported...
    ncolors=$(tput colors)

    if test -n "$ncolors" && test "$ncolors" -ge 8; then
        BOLD="$(tput bold)"
        RED="$(tput setaf 1)"
        GREEN="$(tput setaf 2)"
        YELLOW="$(tput setaf 3)"
        BLUE="$(tput setaf 4)"
        PURPLE="$(tput setaf 5)"
        WATER="$(tput setaf 6)"
        GRAY="$(tput setaf 8)"
        NC="$(tput sgr0)"
    fi
fi

# Function that prints the available commands...
function display_help {
    echo "Wordpress Theme Template"
    echo
    echo "${YELLOW}Usage:${NC}" >&2
    echo "  wp-template [options]"
    echo
    echo "${YELLOW}Commands:${NC}"
    echo "  ${GREEN}wp-template init${NC}                           WordPressテーマテンプレートの初期化"
    echo
    echo "  ${GREEN}wp-template setup${NC}                          WordPressの初期セットアップ"
    echo
    echo "  ${GREEN}wp-template deploy${NC}                         テーマファイルのデプロイ（コピー）"
    echo "  ${GREEN}wp-template deploy --develop (--dev)${NC}"

    exit
}

if [ $# -ge 0 ]; then
    if [ -z "$1" ] || [ "$1" == "help" ] || [ "$1" == "-h" ] || [ "$1" == "-help" ] || [ "$1" == "--help" ]; then
        display_help
    fi
fi

###################################################################################################

#=====================================================
#	Initialize
#=====================================================
if [ "$1" == "init" ]; then

    docker-compose down
    docker-compose build --no-cache
    docker-compose up -d

    clear
    echo
    echo "=== Theme directory setup"
    echo
    echo -n "${WATER}?${NC} What is your Theme directory name? "
    read -r THEME_NAME
    if [ -z "$THEME_NAME" ]; then
        exit 1
    fi
    cp -r ./my-theme ./html/wp-content/themes/"$THEME_NAME"
    echo
    echo "${WATER}[INFO]${NC} Created new theme directory."
    echo "${GRAY}-> html/wp-content/themes/$THEME_NAME${NC}"

    cp README.theme.md ./html/wp-content/themes/"$THEME_NAME"/README.md
    echo
    echo "${WATER}[INFO]${NC} Created README.md"
    echo "${GRAY}-> html/wp-content/themes/${THEME_NAME}/README.md${NC}"

    mkdir ./html/wp-content/themes/"$THEME_NAME"/.vscode/
    cp settings.example.json ./html/wp-content/themes/"$THEME_NAME"/.vscode/settings.json
    echo
    echo "${WATER}[INFO]${NC} Created vscode setting file."
    echo "${GRAY}-> html/wp-content/themes/${THEME_NAME}/.vscode/.settings.json${NC}"

    {
        echo
        echo "php_value upload_max_filesize 1024M"
        echo "php_value post_max_size 1024M"
        echo "php_value memory_limit 256M"
        echo "php_value max_execution_time 300"
        echo "php_value max_input_time 300"
        echo
    } >>./html/.htaccess

    echo
    echo "=== Git setup"
    echo
    # echo "${WATER}[INFO]${NC} Deleted current git files."
    # echo "${GRAY}-> .git/ .gitignore${NC}"
    # rm -rf .git
    # rm .gitignore
    echo
    echo "${WATER}[INFO]${NC} Initialized git repository."
    cd ./html/wp-content/themes/"$THEME_NAME" || exit 1
    git init

    echo
    echo "${GREEN}Setup Completed!${NC}"
    echo
    echo "Next step..."
    echo "${GRAY}\$${NC} rm -rf .git"
    echo "${GRAY}\$${NC} rm .gitignore"
    echo
    echo "${GRAY}\$${NC} cd ./html/wp-content/themes/$THEME_NAME"
    echo "${GRAY}\$${NC} git add -A"
    echo "${GRAY}\$${NC} git commit -m \"first commit\""
    echo "${GRAY}\$${NC} git remote add origin <URL>"
    echo "${GRAY}\$${NC} git push -u origin main"

    {
        echo
        echo THEME_NAME="$THEME_NAME"
    } | tee -a "$BASE_DIR"/.deploy.conf "$BASE_DIR"/.deploy.develop.conf >/dev/null

#=====================================================
#	Wordspress setup
#=====================================================
elif [ "$1" == "setup" ]; then
    source "$BASE_DIR"/.deploy.conf
    source "$BASE_DIR"/.env

    WORDPRESS_CONTAINER_ID=$(docker ps -q -f status=running -f name=wordpress)

    if [ -z "$WORDPRESS_CONTAINER_ID" ]; then
        echo "${GRAY}WordPress container is not runnning.${NC}"
    fi

    echo
    echo "${BLUE}=== Created wp-config.${NC}"
    docker exec -it "$WORDPRESS_CONTAINER_ID" rm wp-config.php
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp config create \
        --dbname="$WORDPRESS_DB_NAME" \
        --dbuser="$WORDPRESS_DB_USER" \
        --dbpass="$WORDPRESS_DB_PASSWORD" \
        --dbhost="$WORDPRESS_DB_HOST" \
        --allow-root

    # core install
    echo
    echo "${BLUE}=== WordPress core setup.${NC}"
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp core install \
        --url="http://localhost:8080" \
        --title="${THEME_NAME}" \
        --admin_user="${WORDPRESS_USER:=admin}" \
        --admin_password="${WORDPRESS_USER_PASSWORD:=admin}" \
        --admin_email="${WORDPRESS_USER_EMAIL:=admin}" \
        --allow-root
    # タイムゾーン
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp option update timezone_string 'Asia/Tokyo' --allow-root
    # パーマリンク
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp rewrite structure '/%post_id%/' --allow-root

    # 言語設定
    echo
    echo "${BLUE}=== Installing language.${NC}"
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp language core install --allow-root --activate ja

    # デフォルトテーマの削除
    echo
    echo "${BLUE}=== Deleting default themes.${NC}"
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp theme activate --allow-root "$THEME_NAME"
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp theme delete --allow-root twentytwentyone
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp theme delete --allow-root twentytwentytwo
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp theme delete --allow-root twentytwentythree

    # デフォルトプラグインの削除
    echo
    echo "${BLUE}=== Deleting default plugins.${NC}"
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp plugin delete --allow-root hello.php
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp plugin delete --allow-root akismet

    # wp update
    echo
    echo "${BLUE}=== Updating wp core.${NC}"
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp core update --allow-root

    # 推奨プラグインのインストール
    echo
    echo "${BLUE}=== Installing reccomend plugins.${NC}"
    # docker exec -it "$WORDPRESS_CONTAINER_ID" wp plugin install contact-form-7 --allow-root
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp plugin install advanced-custom-fields --activate --allow-root

    docker exec -it "$WORDPRESS_CONTAINER_ID" wp language core update --allow-root
    docker exec -it "$WORDPRESS_CONTAINER_ID" wp language plugin update --all --allow-root

#=====================================================
#	Deploy
#=====================================================
elif [ "$1" == "deploy" ] || [ "$1" == "d" ]; then

    if [ "$2" == "--develop" ] || [ "$2" == "--dev" ]; then
        IGNORE_FILE=".deployignore.develop.conf"

        if [ ! -e "$BASE_DIR"/.deploy.develop.conf ]; then
            echo "${GRAY}.deploy.develop.conf is not found.${NC}" && exit 1
        fi

        source "$BASE_DIR"/.deploy.develop.conf
        echo
        echo "${BLUE}=== Deployment to develop${NC}"
        echo
    else
        IGNORE_FILE=".deployignore.conf"

        if [ ! -e "$BASE_DIR"/.deploy.conf ]; then
            echo "${GRAY}.deploy.conf is not found.${NC}" && exit 1
        fi

        source "$BASE_DIR"/.deploy.conf
        echo "$RED"
        echo "■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■"
        echo "■               DEPLOYMENT TO PRODUCTION                ■"
        echo "■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■"
        echo "$NC"
    fi

    if [ -z "$THEME_NAME" ] || [ -z "$SSH_HOST_ALIAS" ] || [ -z "$DEPLOY_PATH" ]; then
        echo "variable error" && exit 1
    fi

    echo "theme     : ${YELLOW}${THEME_NAME}${NC}"
    echo "ssh host  : ${YELLOW}${SSH_HOST_ALIAS}${NC}"
    echo "directory : ${YELLOW}${DEPLOY_PATH}${NC}"
    echo
    echo -n "${WATER}?${NC} Are you sure you want to deploy? ${GRAY}[y/N]${NC} "
    read -r ANSWER
    if [ "$ANSWER" = "y" ]; then
        echo
        echo "${WATER}[INFO]${NC} Start deployment..."
        echo
        echo "${WATER}[INFO]${NC} Copying files..."
        echo "${GRAY}-> ${DEPLOY_PATH}${NC}"
        rsync -avh "$BASE_DIR"/html/wp-content/themes/"$THEME_NAME"/ "$SSH_HOST_ALIAS":"$DEPLOY_PATH" --exclude-from="$BASE_DIR"/"$IGNORE_FILE"
        echo
        echo "${GREEN}Deployment completed!${NC}"
    fi

else
    display_help
fi
