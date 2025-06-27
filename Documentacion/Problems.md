# Problemas por resolver
## Problema actual
Si me logueo voy a Listado.vue (modificado el config/fortify.php, home)
Si estoy logueado y doy a Login (botón en Welcome.vue), me lleva a dasboard. Necesito controlar el redireccionamiento en ese caso
### Si accedo con admin obtengo un page expired
;Situación
Al ser logueado con admin, ejecuto un middleware [ConditionalInertiaMiddleware](./../app/Http/Middleware/ConditionalInertiaMiddleware.php)
El problema es que he añadido un middleware para que no cifre la cookie.
Solucionado, problema que no aplicaba el middleware de las cookies y la necesito, ya quye es la forma en la que inertia recupera el token

### Al  hacer el logout de filament no mantiene el idioma selecionado en filament
* Prioridad media
* Empieza 23/04/2025
* 
