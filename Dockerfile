# --- Stage 1: Build the PHP base image with dependencies ---
FROM composer:2 as vendor

WORKDIR /app
COPY . .
# Install production dependencies only
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader


# --- Stage 2: Build the final production image ---
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install Nginx and essential PHP extensions
RUN apk update && apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

# Copy the application code and vendor files from the previous stage
COPY --from=vendor /app /var/www

# Copy the Nginx configuration and startup script
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Fix line endings (as a safety measure) and make the script executable
RUN sed -i 's/\r$//' /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set correct permissions for storage and bootstrap/cache folders
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 8080, which we have hardcoded in our nginx.conf
EXPOSE 8080

# Set the entrypoint to our startup script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
