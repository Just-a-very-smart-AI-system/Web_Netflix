#!/bin/bash

# Cấp quyền lại (phòng trường hợp bị mất quyền)
chmod -R 777 storage bootstrap/cache

# Tạo APP_KEY nếu chưa có
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

if [ -z "$(grep 'APP_KEY=' .env | cut -d '=' -f2)" ]; then
    php artisan key:generate
fi

# Tạo symbolic link cho storage (nếu cần)
php artisan storage:link || true

# Chờ database sẵn sàng rồi mới chạy migrate
echo "Waiting for database..."
sleep 10

php artisan migrate --force || true

# Chạy Apache
apache2-foreground
