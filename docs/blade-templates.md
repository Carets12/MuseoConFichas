# Plantillas con Blade

Como ya dijimos, Blade es el motor Web de Laravel, pero una vez 
creadas nuestras primeras dos o tres vistas, seguro que estarás 
pensando en cómo hacer para que todas estas vistas puedan compartir
partes comunes, como CSS (colores, tipografías), menús, cabecera y pié
de página...

Sabemos que con PHP es sencillo hacer esto gracias a instrucciones como
*include*, *require* o *require_once*, pero Blade ofrece una manera 
alternativa muy interesante también.

## Herencia de plantillas

Dos de las principales ventajas de Blade es que permite herencia de
plantillas y secciones. 

Como muchas de las aplicaciones Web que desarrollamos mantienen casi
el mismo layout o diseño a lo largo de varias de sus páginas Web,  
es interesante definir este diseño como una vista Blade:

```html
<!-- Guarda este fichero en resources/views/layouts/app.blade.php -->
<html>
    <head>
        <title>Nombre de la aplicación: - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            Esta es la barra lateral maestra.
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
```
Como se puede observar, este archivo contiene una estructura HTML típica. Sin embargo, 
se puede tomar nota de las directivas @section y @yield. La directiva @section, como su
nombre indica, define un sección de contenido, mientras que la directiva @yield es 
utilizada para mostrar el contenido de una sección.

Una vez que se tiene definido un layout para la aplicación, se puede definir una página 
hija que hereda de este layout.

### Heredar un layout

Cuando definimos una vista hija, hay que usar la directiva Blade @extends para especificar de 
qué layout debe "heredar". Las vistas que extienden un layout de Blade pueden inyectar 
contenido en las secciones mediante las directivas @section. Recordar, como se ve en el 
ejemplo anterior, el contenido de estas secciones se mostrará el layout utilizando @yield:7

```html
<!-- Guarda este fichero en resources/views/child.blade.php -->
@extends('app')
@section('title', 'Page Title')
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')
    <p>This is my body content.</p>
@endsection
```

En este ejemplo, la sección sidebar está utilizando la directiva @parent para anexar 
(más que sobrescribir) contenido al sidebar de la plantilla padre. La directiva @parent 
será reemplazada por el contenido del layout cuando se procese la vista.

