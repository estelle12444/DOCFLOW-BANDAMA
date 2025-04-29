FROM php:8.2-apache

# 1. Configuration de base
WORKDIR /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1

# 2. Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# 3. Installation de Node.js 20.x (LTS actuelle)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# 4. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copie des fichiers de dépendances
COPY composer.json  package.json package-lock.json ./

# 6. Installation des dépendances PHP
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# 7. Installation des dépendances Node.js
RUN npm install --force --legacy-peer-deps

# 8. Build des assets
RUN npm run build

# 9. Copie du reste de l'application
COPY . .

# 10. Configuration des permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 775 storage bootstrap/cache \
    && a2enmod rewrite

# 11. Nettoyage
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 10000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
