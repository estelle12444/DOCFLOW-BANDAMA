#!/usr/bin/env bash

# Install PHP dependencies
composer install --no-interaction --no-dev --prefer-dist

# Générer la clé d'application
php artisan key:generate

# Optimiser l'application
php artisan optimize

# Migrer la base de données (optionnel - vous pouvez le faire manuellement)
# php artisan migrate --force
