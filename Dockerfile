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
WORKDIR /var/www/Web_Netflix

# Sao chép toàn bộ project Laravel vào container
COPY . .

# Sao chép file cấu hình Apache vào container
COPY laravel.conf /etc/apache2/sites-available/laravel.conf

# Cấu hình Apache để trỏ vào thư mục public
RUN a2ensite laravel.conf \
    && a2dissite 000-default.conf \
    && a2enmod rewrite

# Cấp quyền cho storage, cache và public
RUN chmod -R 777 storage bootstrap/cache
RUN chmod -R 755 public public/css public/js

# Cài đặt dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Chạy Artisan commands nếu cần
RUN php artisan storage:link || true
RUN php artisan key:generate
RUN php artisan migrate --force || true

# Xóa cache Laravel
RUN php artisan config:clear
RUN php artisan cache:clear

# Mở cổng 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
