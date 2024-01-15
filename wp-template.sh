#!/usr/bin/env bash

UNAMEOUT="$(uname -s)"

# Verify operating system is supported...
case "${UNAMEOUT}" in
    Linux*)             MACHINE=linux;;
    Darwin*)            MACHINE=mac;;
    *)                  MACHINE="UNKNOWN"
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
    
    exit 1
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
    read -r DIR
    if [ -z "$DIR" ]; then
        exit 1
    fi
    cp -r ./my-theme ./html/wp-content/themes/"$DIR"
    echo
    echo "${WATER}[INFO]${NC} Created new theme directory."
    echo "${GRAY}-> html/wp-content/themes/$DIR${NC}"
    
    cp README.theme.md ./html/wp-content/themes/"$DIR"/README.md
    echo
    echo "${WATER}[INFO]${NC} Created README.md"
    echo "${GRAY}-> html/wp-content/themes/${DIR}/README.md${NC}"
    
    mkdir ./html/wp-content/themes/"$DIR"/.vscode/
    cp .settings.exapmle.json ./html/wp-content/themes/"$DIR"/.vscode/.settings.json
    echo
    echo "${WATER}[INFO]${NC} Created vscode setting file."
    echo "${GRAY}-> html/wp-content/themes/${DIR}/.vscode/.settings.json${NC}"
    
    {
        echo
        echo "php_value upload_max_filesize 1024M"
        echo "php_value post_max_size 1024M"
        echo "php_value memory_limit 256M"
        echo "php_value max_execution_time 300"
        echo "php_value max_input_time 300"
        echo
    } >> ./html/.htaccess
    
    echo
    echo "=== Git setup"
    echo
    echo "${WATER}[INFO]${NC} Deleted current git files."
    echo "${GRAY}-> .git/ .gitignore${NC}"
    rm -rf .git
    rm .gitignore
    cd ./html/wp-content/themes/"$DIR" || exit
    git init
    
    echo
    echo "${GREEN}Setup Completed!${NC}"
    echo
    echo "Next step..."
    echo "${GRAY}\$${NC} cd ./html/wp-content/themes/$DIR"
    echo "${GRAY}\$${NC} git add -A"
    echo "${GRAY}\$${NC} git commit -m \"first commit\""
    echo "${GRAY}\$${NC} git remote add origin <URL>"
    echo "${GRAY}\$${NC} git push -u origin main"
    
else
    display_help
fi