#!/bin/bash
set -e

cd /data

# マイグレーション実行
php artisan migrate --force

# キャッシュ最適化
php artisan optimize

# supervisord でNginx + PHP-FPM を起動
exec supervisord -c /etc/supervisord.conf
