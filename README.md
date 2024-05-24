# Aplicación de Repositorios de proyectos

Un fichero de requisitos está en (./documenacion/requisitos.docs)

# Uso de Librerías
Instala el paquete del cliente de Google: 
Puedes incluir este paquete en tu proyecto Laravel mediante Composer. 
Ejecuta el siguiente comando en tu terminal:

``` bash
composer require google/apiclient
```

* Configura las credenciales de Google API:
Debes crear un proyecto en Google Cloud, habilitar la API de Google Drive para ese proyecto, y generar credenciales (normalmente un archivo JSON) que tu aplicación Laravel utilizará para autenticarse con Google. Este proceso se realiza en la consola de Google Cloud.

* Implementa la autenticación:
 Utiliza las credenciales obtenidas para autenticar tu aplicación con Google. Esto generalmente implica cargar el archivo de credenciales JSON en tu aplicación y utilizarlo para crear un cliente autorizado con el SDK de Google.

* Accede a Google Drive:
* Una vez autenticado, puedes usar el cliente de Google para realizar operaciones en Google Drive, como listar archivos, subir nuevos archivos, o descargar archivos existentes. El cliente te permite interactuar con Drive a través de una serie de métodos disponibles en el SDK.

* Integración con Inertia:
 La lógica para interactuar con Google Drive estará en el lado del servidor de Laravel. Puedes exponer esta funcionalidad a tu frontend Vue.js mediante controladores Laravel, que devuelven datos o vistas que Inertia puede manejar. Desde el frontend, puedes realizar solicitudes a estos controladores para acceder o modificar tus archivos en Google Drive.


## Atribuciones
*Imagen de fondo
>Imagen de <a href="https://www.freepik.es/foto-gratis/papeles-comerciales-naturaleza-muerta-varias-piezas-mecanismo_24749607.htm#query=gestion%20proyectos&position=1&from_view=keyword&track=ais&uuid=7979d323-213f-4ebc-acdd-9a17cab7c51c">Freepik</a>


# Programas usados
* ***pick*** para capturar colores
```bash
sudo snap install pick-colour-picker --classic
```


## Traducciones
```bash
composer require --dev laravel-lang/common
```
Me dio un problema y es que faltaba una librería de php
```bash
sudo apt-get install php8.3-bcmath 
```



*La configuración por defecto del idioma en ***.env*** 
```json
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
```
*Generamos la carpeta lang
```php

```



## Pendiente (1/04/2024)
Estoy con el cambio de idiomas a través del componente Dropdown
## [Idiomas](./Documentacion/idiomas.md)    

## [Login]()

1. -Subir a git con CI/CA
1. -Desplegar el web.infenlaces.com
1. - Tema de autenticación 
1. - Roles: **Admin, alumno, profesor**


## Actual
!(Actual en desarrollo)[./Documentacion/actual.md]
