## Enrutamiento en Laravel 

### Enrutamiento básico

Suponiendo que nuestro proyecto está en la carpeta ~/code, en el fichero 
**routes/web.php** se definen las rutas disponibles para la interfaz Web.

Si lo que queremos hacer es programar una API RESTFUL, entonces hemos
de trabajar el fichero: **routes/api.php**.

### Hola Mundo

Abre el fichero **routes/web.php** en tu editor favorito y vamos a jugar 
con el enrutador de Laravel. Añade la siguiente entrada:

```php
Route::get('/saluda', function () {
    return "Hola Mundo";
});
```
Ahora abre en un navegador Web la ruta 
[http://homestead.app/saluda](http://homestead.app/saluda) 
y comprueba que todo haya funcionado.

### Métodos disponibles

Una vez hemos visto cómo funciona el enrutador, nos 
surge la pregunta... ¿puedo usar todos los verbos HTTP 
en las rutas que defino? Por supuesto que sí, de este
modo:

```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
```

### Rutas con parámetros

```php
Route::get('ficha/{name}', function ($name) {
    return "Buscando el usuario con nombre: $name";
})->where('name', '[A-Za-z]+');
```

### Parámetros opcionales y valores por defecto

```php
Route::get('ficha/{id?}', function ($id=null) {
    if ($id==null){
        return "Listado de todas las fichas:....";
    } else {
        return view('ficha' , ['id'=>$id]);
    }
})->where('id', '[0-9]+'); 
```

### Múltiples parámetros

```php
Route::get('user/name/{name}/lastname/{lastname}', function ($name, $lastname){
    return "Buscando a un usuario con nombre: $name y apellido: $lastname";    
})->where(['name' => '[A-Za-z\s]+','lastname'=>'[A-Za-z\s]+']);

```

