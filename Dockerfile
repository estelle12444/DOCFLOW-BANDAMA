# Étape 1 : Image de base PHP avec Apache
FROM php:8.2-apache

# Étape 2 : Définir le répertoire de travail
WORKDIR /var/www/html

# Étape 3 : Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs 

# Étape 4 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock package.json package-lock.json 

# Étape 5 : Copier les fichiers (sauf ceux dans .dockerignore)
COPY . .

# Étape 6 : Configurer les permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage \
    && php artisan storage:link
    

# Étape 7 : Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

RUN npm install 
RUN npm run build

# Étape 8 : Port d'exposition (obligatoire pour Render)
EXPOSE 10000

# Étape 9 : Commande de démarrage
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
