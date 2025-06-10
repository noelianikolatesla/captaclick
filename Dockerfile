FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia todo el proyecto
COPY . /var/www/html

# Cambia el DocumentRoot a la carpeta 'public'
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Activa el módulo de reescritura
RUN a2enmod rewrite

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Crea carpetas necesarias y da permisos
RUN mkdir -p \
    storage/app \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Instala dependencias de Laravel
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist --optimize-autoloader

# Exponer el puerto
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
