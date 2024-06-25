## Instalamos laravel permision
1. Instalamos
```bash
composer require spatie/laravel-permission
```
2. Publicamos las migraciones
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
3. Borramos la cache
```bash
php artisan config:clear
```
4. Ejecutamos las migraciones
```bash
 php artisan migrate
 
```
