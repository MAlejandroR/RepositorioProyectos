## Laravel Scout 
https://laravel.com/docs/12.x/scout

Es una herramienta de laravel  para realizar búsquedas eficientes y avanzadas  en la base de datos usando textos largos y en lenguaje natural.

Se integra con motores de búsqueda como *Algolia* o *Meilisearch*, o se puede usar a traves del motor de búsqueda *colección* (por defecto).

Scout indexa de forma automática los modelos de Eloquent y encuentra registros mediante frases, palabras clave o búsquedas como hace Google.

## Instalación
```bash
composer require laravel/scout
```
* Publicamos fichero de configuración
```bash
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
```
* El modelo al que queremos aplicar este tipo de búsqueda hay que añadir el trait **Searchable**
```php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
 
class Post extends Model
{
    use Searchable;
}
```

# Tema de crear colas
En Laravel Scout, algunas operaciones como sincronizar modelos con un motor de búsqueda externo pueden tardar. Para mejorar el rendimiento, Laravel permite usar tareas en cola (queues) que se ejecutan en segundo plano. Sin embargo, no todos los drivers lo necesitan.

No es necesario usar queue cuando utilizas el driver collection.

| Driver       | ¿Necesita `queue`? | ¿Por qué?                                                        |
|--------------|--------------------|-------------------------------------------------------------------|
| `collection` | ❌ No              | Solo usa datos cargados en memoria, no hay sincronización        |
| `database`   | ❌ Opcional         | Busca directamente en columnas de la base de datos               |
| `algolia`    | ✅ Recomendado      | Hay que sincronizar datos con la API de Algolia                  |
| `meilisearch`| ✅ Recomendado      | Igual que arriba, sincroniza modelos                             |
| `typesense`  | ✅ Recomendado      | Requiere enviar datos al motor externo                           |






Si estás empezando, usa el driver collection, ya que no necesita configuración extra.

Cuando domines el flujo básico, puedes probar Meilisearch o Typesense si deseas búsquedas más potentes.

Para estos últimos, recuerda usar queue y lanzar el worker con:

```bash
php artisan queue:work
```


