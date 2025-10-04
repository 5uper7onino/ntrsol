#!/bin/bash
# ---------------------------------------------------------
# Laravel permissions fixer
# Uso:
#   ./fix-laravel-perms.sh [usuario] [grupo]
# Ejemplo:
#   ./fix-laravel-perms.sh ubuntu www-data
# ---------------------------------------------------------

# Tomar parámetros o usar valores por defecto
USER=${1:-ubuntu}
GROUP=${2:-www-data}

echo "🔧 Reparando permisos de Laravel con usuario: $USER y grupo: $GROUP..."
cd "$(dirname "$0")" || exit

# Ajustar propietario y grupo
sudo chown -R $USER:$GROUP storage bootstrap/cache

# Permisos 775 para usuario y grupo
sudo chmod -R 775 storage bootstrap/cache

# Mantener grupo en nuevas carpetas
sudo find storage bootstrap/cache -type d -exec chmod g+s {} \;

# Limpieza opcional de cachés
php artisan cache:clear 2>/dev/null
php artisan config:clear 2>/dev/null
php artisan route:clear 2>/dev/null
php artisan view:clear 2>/dev/null

echo "✅ Permisos reparados y cachés limpiadas correctamente."
