#!/bin/bash
echo "🔹 Đang kiểm tra thư mục..."
ls -l /var/www/html
ls -l /var/www/Web_Netflix/public

echo "🔹 Thiết lập quyền..."
chmod -R 775 storage bootstrap/cache

echo "🔹 Cấu hình Apache..."
rm -rf /var/www/html
ln -s /var/www/Web_Netflix/public /var/www/html

echo "<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html
    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/laravel.conf

a2ensite laravel.conf
a2dissite 000-default.conf
a2enmod rewrite
service apache2 restart

echo "✅ Deploy hoàn tất!"
