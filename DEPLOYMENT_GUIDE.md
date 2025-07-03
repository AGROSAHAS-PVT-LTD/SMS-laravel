# VPS Deployment Guide

## Prerequisites
1. Ubuntu 20.04/22.04 VPS
2. SSH access with sudo privileges
3. GitHub repository access

## VPS Setup
Run these commands on your VPS:

```bash
# Install required software
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx mysql-server php-fpm php-mysql php-mbstring php-xml php-zip php-curl composer nodejs npm git

# Configure MySQL
sudo mysql_secure_installation

# Create deployment directory
sudo mkdir -p /var/www/sms-laravel
sudo chown -R $USER:$USER /var/www/sms-laravel
```

## GitHub Secrets Setup
1. Go to Repository Settings > Secrets > Actions
2. Add these secrets:
   - `SSH_PRIVATE_KEY`: Your SSH private key
   - `SSH_USER`: VPS username (usually 'root')
   - `SSH_HOST`: VPS IP address
   - `DEPLOY_PATH`: Deployment path (e.g. '/var/www/sms-laravel')

## Nginx Configuration
Create `/etc/nginx/sites-available/sms-laravel` with:

```nginx
server {
    listen 80;
    server_name your_domain.com;
    root /var/www/sms-laravel/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Enable the site:
```bash
sudo ln -s /etc/nginx/sites-available/sms-laravel /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

## First Deployment
1. Push to main branch to trigger deployment
2. SSH into VPS and complete setup:
```bash
cd /var/www/sms-laravel
php artisan migrate --seed
