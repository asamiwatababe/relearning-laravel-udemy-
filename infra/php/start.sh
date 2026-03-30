#!/bin/bash
set -e

cd /data

# Render の PORT 環境変数に対応（デフォルト80）
export PORT="${PORT:-80}"

# nginx 設定をテンプレートから生成
envsubst '${PORT}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

# マイグレーション実行
php artisan migrate --force

# キャッシュ最適化
php artisan optimize

# supervisord でNginx + PHP-FPM を起動
exec supervisord -c /etc/supervisord.conf
