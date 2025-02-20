rm -rf /var/www/html
ln -s /var/www/Web_Netflix/public /var/www/html
#!/bin/bash
# Cài đặt quyền truy cập cho thư mục storage và bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Cài đặt lại Apache để trỏ vào thư mục public
echo "<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/laravel.conf

# Bật site mới
a2ensite laravel.conf
a2dissite 000-default.conf
a2enmod rewrite
service apache2 restart
