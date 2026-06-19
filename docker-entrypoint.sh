#!/bin/bash
set -e
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true
php artisan migrate --force 2>/dev/null || true
exec php artisan serve --host=0.0.0.0 --port=10000
