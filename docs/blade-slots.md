# BLADE

## Componentes & Slots

Los componentes y los slots proporcionan beneficios similares a las secciones y los layouts; sin embargo, algunos pueden encontrar el modelo mental de componentes y slots más fáciles de entender. Primero, imaginemos un componente de "alerta" reutilizable que seria util en toda nuestra aplicación:

```html
<!-- /resources/views/alert.blade.php -->
<div class="alert alert-danger">
    {{ $slot }}
</div>
```

La variable {{ $slot }} contendrá lo que deseamos inyectar en el componente. Ahora, para construir este componente, podemos usar la directiva Blade @component:

```html
@component('alert')
    <strong>Whoops!</strong> Something went wrong!
@endcomponent
```

A veces es útil definir varios slots para un componente. Vamos a modificar nuestro componente de alerta para permitir la inyección de un "title". El contenido de los slots con nombre se puede mostrar simplemente "imprimiendo" (echoing) la variable que coincide con su nombre:

```html
<!-- /resources/views/alert.blade.php -->
<div class="alert alert-danger">
    <div class="alert-title">{{ $title }}</div>
    {{ $slot }}
</div>
```

Ahora, podemos inyectar contenido en el slot usando la directiva @slot. Cualquier contenido que no esté dentro de una directiva @slot pasará al componente en la variable $slot:

```html
@component('alert')
    @slot('title')
        Forbidden
    @endslot

    You are not allowed to access this resource!
@endcomponent
```

### Pasar datos adicionales a los componentes

A veces, es posible que necesite transferir datos adicionales a un componente. Por esta razón, puede pasar una matriz de datos como segundo argumento a la directiva @componente. Todos los datos se pondrán a disposición de la plantilla del componente como variables:

```html
@component('alert', ['foo' => 'bar'])
    ...
@endcomponent
```

>  Las declaraciones Blade {{ }} se envían automáticamente a través
>  de la función PHP htmlspecialchars para prevenir ataques XSS.

