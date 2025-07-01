## 
https://filamentphp.com/docs/3.x

* Instalación
```bash
 composer require filament/filament:"^3.3" -W
 php artisan filament:install --panels
```
> Necesario php-intl (Paquete de internacionalización). 
 
> La instalación instala también los siguientes paquetes, que son utilidades en torno a filament para construir la aplicación de panel de administración:
> * Form Builder
> * Table Builder
> * Notifications
> * Actions
> * Infolists
> * Widgets

* Crear usuario
 No necesario, puedo usar un usuario del sistema, en mi caso un usuario con rol de admin
 
```bash
php artisan make:filament-user
```

* Visualizando datos
Para ello hay que completar en la clase del recurso correspondiente el método columns de la clase Table que retorna el método table
 
* 
## El panel de administración

* Gesionado por la clase ./app/Providers/Filament/AdminPanelProvider
