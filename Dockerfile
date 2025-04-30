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
#RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage  /var/www/html/bootstrap/cache
    

# Étape 7 : Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

RUN npm install 
RUN npm run build

# Étape 8 : Configurer les permissions
RUN mkdir -p /var/www/html/storage/app/public \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Étape 9 : Configurer Apache pour servir les fichiers storage
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN echo "Alias /storage /var/www/html/storage/app/public" > /etc/apache2/conf-available/storage.conf \
    && echo "<Directory /var/www/html/storage/app/public>" >> /etc/apache2/conf-available/storage.conf \
    && echo "    Options Indexes FollowSymLinks" >> /etc/apache2/conf-available/storage.conf \
    && echo "    AllowOverride None" >> /etc/apache2/conf-available/storage.conf \
    && echo "    Require all granted" >> /etc/apache2/conf-available/storage.conf \
    && echo "</Directory>" >> /etc/apache2/conf-available/storage.conf \
    && a2enconf storage \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


RUN php artisan storage:link

# Étape 8 : Port d'exposition (obligatoire pour Render)
#    EXPOSE 10000
EXPOSE 80
# Étape 9 : Commande de démarrage
#CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]

CMD ["apache2-foreground"]

