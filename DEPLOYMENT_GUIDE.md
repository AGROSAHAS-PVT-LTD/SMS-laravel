# VPS Deployment Guide

## Prerequisites
1. Ubuntu 20.04/22.04 VPS
2. SSH access with sudo privileges
3. GitHub repository access

## VPS Setup
Run these commands on your VPS:

```bash
# Install required software (PHP 8.2+)
sudo apt update && sudo apt upgrade -y
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y nginx mysql-server php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-zip php8.2-curl composer nodejs npm git
npm install -g vue@latest
npm install -g @vue/cli

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

## DNS Configuration
1. Create an A record in your DNS management panel pointing your subdomain (e.g., sms.your_domain.com) to your VPS IP address

## Nginx Configuration
Create `/etc/nginx/sites-available/sms-laravel` with:

```nginx
server {
    listen 80;
    # server_name sms.your_domain.com;  # Replace with your actual subdomain
    server_name 84.46.250.62
    root /var/www/sms-laravel/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
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
npx update-browserslist-db@latest
npm install vue-loader@latest
php artisan migrate --seed
