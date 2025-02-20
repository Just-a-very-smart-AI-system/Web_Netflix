#!/bin/bash

# Cấp quyền truy cập cho storage & bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Xóa thư mục mặc định và tạo symlink trỏ vào thư mục public của Laravel
if [ -d "/var/www/Web_Netflix/public" ]; then
    rm -rf /var/www/html
    ln -s /var/www/Web_Netflix/public /var/www/html
fi

# Cấu hình lại Apache
cat <<EOF > /etc/apache2/sites-available/laravel.conf
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html
    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# Kích hoạt site Laravel
a2ensite laravel.conf
a2dissite 000-default.conf
a2enmod rewrite
service apache2 restart
