# Aplicación de Repositorios de proyectos

Un fichero de requisitos está en (./documenacion/requisitos.docs)

# Uso de Librerías
Instala el paquete del cliente de Google: Puedes incluir este paquete en tu proyecto Laravel mediante Composer. Ejecuta el siguiente comando en tu terminal:

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
