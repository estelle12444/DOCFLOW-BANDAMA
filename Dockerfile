# Dockerfile pour Laravel sur Render
FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de l'application
COPY . /var/www/html

# Configurer Apache
RUN chown -R www-data:www-data /var/www/html/storage
RUN a2enmod rewrite

# Installer les dépendances
RUN composer install --no-dev --optimize-autoloader

# Exposer le port
EXPOSE 10000

# Commande de démarrage
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
