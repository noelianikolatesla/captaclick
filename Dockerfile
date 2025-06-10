# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia el proyecto dentro del contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Da permisos y prepara Laravel
RUN composer install \
    && cp .env.example .env \
    && php artisan key:generate \
    && php artisan config:cache

# Expone el puerto 80 para el servidor web
EXPOSE 80

# Comando para iniciar Apache al arrancar el contenedor
CMD ["apache2-foreground"]
