#!/bin/bash

# Copier .env.example vers .env s'il n'existe pas
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Générer la clé d'application si APP_KEY n'est pas défini
if grep -q "APP_KEY=\$" .env || grep -q "APP_KEY=$" .env; then
    php artisan key:generate
fi

# Mettre à jour les configurations
php artisan config:cache
php artisan route:cache

# Exécuter les migrations
php artisan migrate --force

# Démarrer Apache en premier plan
apache2-foreground
