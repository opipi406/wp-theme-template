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
    echo "  ${GREEN}wp-template init${NC}       WordPressテーマテンプレートの初期化"

    exit
}

if [ $# -ge 0 ]; then
    if [ -z "$1" ] || [ "$1" == "help" ] || [ "$1" == "-h" ] || [ "$1" == "-help" ] || [ "$1" == "--help" ]; then
        display_help
    fi
fi

###################################################################################################

if [ "$1" == "init" ]; then
    docker-compose down
    docker-compose build
    docker-compose up -d

    clear
    echo
    echo "=== Theme directory setup"
    echo
    echo -n "${WATER}?${NC} What is your Theme directory name? "
    read -r THEME_NAME
    if [ -z "$THEME_NAME" ]; then
        exit
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
    cp .settings.exapmle.json ./html/wp-content/themes/"$THEME_NAME"/.vscode/.settings.json
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
    echo "${WATER}[INFO]${NC} Deleted current git files."
    echo "${GRAY}-> .git/ .gitignore${NC}"
    rm -rf .git
    rm .gitignore
    cd ./html/wp-content/themes/"$THEME_NAME" || exit 1
    git init

    echo
    echo "${GREEN}Setup Completed!${NC}"
    echo
    echo "Next step..."
    echo "${GRAY}\$${NC} cd ./html/wp-content/themes/$THEME_NAME"
    echo "${GRAY}\$${NC} git add -A"
    echo "${GRAY}\$${NC} git commit -m \"first commit\""
    echo "${GRAY}\$${NC} git remote add origin <URL>"
    echo "${GRAY}\$${NC} git push -u origin main"

    {
        echo
        echo THEME_NAME="$THEME_NAME"
    } | tee -a "$BASE_DIR"/.env "$BASE_DIR"/.env.develop

elif [ "$1" == "deploy" ] || [ "$1" == "d" ]; then

    if [ "$2" == "--develop" ] || [ "$2" == "--dev" ]; then
        IGNORE_FILE=".deployignore.develop.conf"

        if [ ! -e "$BASE_DIR"/.deploy.develop.conf ]; then
            echo "${BOLD}.deploy.develop.conf${NC} is not found." && exit
        fi

        source "$BASE_DIR"/.deploy.develop.conf
        echo
        echo "${BLUE}=== Deployment to production${NC}"
        echo
        exit
    else
        IGNORE_FILE=".deployignore.conf"

        if [ ! -e "$BASE_DIR"/.deploy.conf ]; then
            echo "${BOLD}.deploy.conf${NC} is not found." && exit
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
        rsync -avz "$BASE_DIR"/html/wp-content/themes/"$THEME_NAME" "$SSH_HOST_ALIAS":"$DEPLOY_PATH" --exclude-from="$BASE_DIR"/"$IGNORE_FILE"
        echo
        echo "${GREEN}Deployment completed!${NC}"
    fi

else
    display_help
fi
