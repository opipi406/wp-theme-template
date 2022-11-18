#!/bin/bash

function usage() {
    echo $1
    cat <<_EOT_
Usage:
    bash `basename $0` [-d] [THEME_DIR] ...

Description:
    テーマディレクトリから不要なファイルを取り除いてビルド(コピー)します。
    [THEME_DIR] を省略した場合、自動でビルド対象テーマを探します。

Options:
    --dev [-d] developモードでビルド (assets配下の /scss, /dist.utils, /js/dev を含んでコピーする)
    -h ヘルプ表示

_EOT_
    exit 1
}

MODE="production"
HELP="NO"

POSITIONAL_ARGS=()
while [[ $# -gt 0 ]]; do
    case $1 in
        --dev)   MODE="develop"; shift;;
        --help)  HELP="YES"; shift;;
        --) shift;  POSITIONAL_ARGS+=("$@"); set --;;
        --*) echo "[ERROR] Unknown option $1"; exit 1;;
        -*) #// Multiple short name options. e.g.-fh
            OPTIONS=$1
            for (( i=1; i<${#OPTIONS}; i++ )); do
                case "-${OPTIONS:$i:1}" in
                    -d) MODE="develop";;
                    -h) HELP="YES";;
                    *)  echo "[ERROR] Unknown option -${OPTIONS:$i:1}"; exit 1;;
                esac
            done
        unset OPTIONS; shift;;
        *) POSITIONAL_ARGS+=("$1"); shift;;
    esac
done
set -- "${POSITIONAL_ARGS[@]}"  #// set $1, $2, ...
unset POSITIONAL_ARGS

if [ $HELP = "YES" ]; then
    usage
fi

if [ $MODE = "production" ]; then
    EXCLUDE_FILE=".exclude"
else
    EXCLUDE_FILE=".exclude_dev"
fi

if [ ! -d $1 ]; then
    echo テーマディレクトリ \"$1\" は見つかりません
    exit 0
fi

if [ $1 -n "" ]; then
    TARGET_DIR=$1
else
    CNT=`ls html/wp-content/themes/ | grep -v "twenty" | grep -vc "index.php"`
    if [ $CNT -gt 1 ]; then
        echo テーマディレクトリを自動取得できません。複数の候補が見つかりました。
        echo ---------------------
        ls html/wp-content/themes/ | grep -v "twenty" | grep -v "index.php"
        echo ---------------------
        exit 0
    fi
    TARGET_DIR=`ls html/wp-content/themes/ | grep -v "twenty" | grep -v "index.php"`
fi

if [ $MODE = "production" ]; then
    echo "■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■"
    echo "■                    PRODUCTION MODE                    ■"
    echo "■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■"
    echo "ビルド前に以下のチェックリストを確認してください。"
    echo ""
    echo "--------------------------------------------------------"
    echo "1. utils.cssのパージが完了しているか --> npm run purge:utils"
    echo "2. jsのバンドルが完了しているか --> npm run build:webpack"
    echo "3. bundle.jsを読み込む設定になっているか --> functions.php \"USE_BUNDLE_JS\" を true にする"
    echo "--------------------------------------------------------"
    echo ""
fi

echo ビルド対象のテーマディレクトリ: $TARGET_DIR

echo -n "ビルドしてもよろしいですか? - $MODE [Y/n]: "
read ANSWER
case $ANSWER in
    "Y" | "y" | "yes" | "Yes" | "YES" ) ;;
    * ) exit 0;;
esac

rm -rf dist
mkdir dist

rsync -avh html/wp-content/themes/$TARGET_DIR/ dist/$TARGET_DIR/ --exclude-from="$EXCLUDE_FILE"

echo ""
echo "ビルドが完了しました。"
