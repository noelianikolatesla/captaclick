FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia todo el proyecto
COPY . /var/www/html

# Establece directorio
WORKDIR /var/www/html

# Crea carpetas necesarias y da permisos
RUN mkdir -p bootstrap/cache storage \
    && chmod -R 775 bootstrap/cache storage \
    && chown -R www-data:www-data bootstrap/cache storage

# Instala dependencias sin ejecutar artisan (todavía)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expone puerto Apache
EXPOSE 80

# Arranca Apache
CMD ["apache2-foreground"]

