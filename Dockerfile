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

# Thiết lập DocumentRoot để trỏ vào thư mục public của Laravel
RUN echo "<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/Web_Netflix/public
    <Directory /var/www/Web_Netflix/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Cấu hình Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite

# Cấp quyền cho storage và bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

# Cài đặt dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Chạy sau khi container khởi động (entrypoint script)
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Mở cổng 80
EXPOSE 80

# Khởi động container với script entrypoint
CMD ["docker-entrypoint.sh"]
