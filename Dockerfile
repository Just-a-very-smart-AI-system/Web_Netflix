# Sử dụng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài đặt các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring xml bcmath

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Sao chép toàn bộ project Laravel vào container
COPY . .

# Cấp quyền cho storage và bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

# Cài đặt dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Tạo symbolic link cho storage (nếu cần)
RUN php artisan storage:link || true

# Tạo APP_KEY
RUN php artisan key:generate

# Migrate database (nếu cần)
RUN php artisan migrate --force || true

# Cấu hình Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite

# Mở cổng 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
