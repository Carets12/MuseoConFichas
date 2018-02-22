# Vistas 

El motor de gestión de vistas en Laravel es Blade. Las vistas se
almacenan en la carpeta **resources/view/*.blade.php**, donde 
todas las vistas han de terminar con *.blade.php*.

Veamos en un simple ejemplo cómo funciona. Supongamos que cuando 
se acceda a la ruta **/saluda/nombre** queremos que se muestre en 
una página Web con HTML5 un saludo personalizado con "nombre".

Preparamos la ruta en el fichero **routes/web.php**, donde se invoca
a la vista "saluda" con el parámetro "nombre" con el valor que hayamos
pasado en la variable *$nombre*, que se lee de la propia ruta (mira 
*{nombre}*). Fíjate que además exigimos que el nombre se componga de
letras y algún espacio en blanco (empresión regular *[a-zA-Z\s]+*).

```php
Route::get('ficha/{nombre}', function ($nombre=Pepe) {
    return view('saluda' , ['nombre'=>$nombre]);
})->where('nombre', '[a-zA-Z\s]+'); 
```

Como puede verse, esta ruta devolverá al cliente la vista *saluda*, que 
deberemos tener creada en el fichero **resources/views/saluda.blade.php**:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Saludo</title>
</head>
<body>
    <h1>Hola Mundo Laravel</h1>
    <p>Saludando desde una Web a: {{$nombre}} </p>
</body>
</html>
```

