#!/bin/sh

# Create the run directory for Nginx
mkdir -p /run/nginx

# Set permissions for the Nginx run directory
chown -R www-data:www-data /run/nginx

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
nginx -g "daemon off;"
