# CRUD desde el Controlador

En este apartado vamos a ver cómo usar el modelo de datos generado desde un controlador para completar todas las operaciones CRUD.

Recuerda que vamos a trabajar con el controlador específico de los usuarios que se ha creado a tal efecto con el comando **php artisan make:model -a**, es decir con el fichero *app->Http->Controllers->UsuarioController.app*.

Cuando termines, recuerda enlazar las rutas necesarias desde los menús de la aplicación, por ejemplo: /usuarios y /usuarios/create para poder, desde dichos menús, poder dar acceso directo a toda la funcionalidad del controlador.

## Leer todos: Usuario.findAll()

Para mostrar el listado de todos los usuarios, primero añadimos en el controlador (fichero *app->Http->Controllers->UsuarioController.app*), dentro del método **index()** de la clase, estas dos líneas:

```php
    public function index()
    {
        // Guarda en el array $usuarios la lista de todos los que haya en la BBDD
        // es como un findAll() en JPA
        $usuarios = Usuario::all();
        return view('usuarios.index',compact('usuarios',$usuarios));
    }
```
Usuario::all() devuelve un listado de todos los usuarios de la tabla en la BBDD. Hay que usar esta función con precaución, y, en otros casos, [usar un paginador](https://laravel.com/docs/5.6/pagination).

Fíjate que al controlador le decimos que retorne la vista *usuarios.index*; eso quiere decir que en la carpeta resources->views hay que crear la carpeta usuarios y dentro a su vez el fichero index.blade.php para gestionar esta vista.

Contenido del fichero views->usuarios->index.blade.php

```html
@extends('app')

@section('title', 'Gestión de usuarios')

@section('sidebar')
    @parent
@endsection

@section('content')

 <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Username</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">e-mail</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $usuario)
            <tr>
              <th scope="row">{{$usuario->id}}</th>
              <td><a href="/usuarios/{{$usuario->id}}">{{$usuario->username}}</a></td>
              <td>{{$usuario->nombre}}</td>
              <td>{{$usuario->apellidos}}</td>
              <td>{{$usuario->email}}</td>              
              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('usuarios/' . $usuario->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('usuarios', [$usuario->id])}}" method="POST">
     <input type="hidden" name="_method" value="DELETE">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="submit" class="btn btn-danger" value="Delete"/>
   				  </form>
              </div>
 </td>
            </tr>
            @endforeach
          </tbody>
        </table>

@endsection
```

Fíjate que ya implementamos para cada fila (usuario) un formulario con dos botones que nos llevarán a editar y a borrar respectivamente cada uno de los usuarios. Como en HTML no existen en los formularios los métodos PUT, DELETE, OPTIONS, etc. (es decir, no podemos hacer por ejemplo: &lt;form method="DELETE"&gt;) verás que hacemos cosas como esta:

```html
<input type="hidden" name="_method" value="DELETE">
```
dentro de los formularios en nuestro código para emularlo.

## Leer uno: Usuario.findById(Id)

Muy similar al ejemplo anterior, en este caso lo que hacemos es buscar un usuario por su ID, es decir, queremos consultar la ruta **/usuarios/XX**, donde XX es el Id del usuario a mostrar en detalle.

Hay que modificar el método show del fichero *app->Http->Controllers->UsuarioController.app*:

```php
  public function show(Usuario $usuario)
  {
    // invocamos a la vista usuarios/show
    return view('usuarios.show',compact('usuario',$usuario));
  }
```

Creamos el archivo para la vista como resources->views->usuarios->show.blade.php
```html
@extends('app')

@section('title', 'Gestión de usuarios')

@section('sidebar')
    @parent
@endsection

@section('content')

<h1>Mostrando usuario: {{ $usuario->id }}</h1>
 
 <div class="jumbotron text-center">
     <p>
         <strong>Username:</strong> {{ $usuario->username }} 
    </p>
    <p>
        <strong>Password:</strong> {{ $usuario->password }}
    </p>
    <p>
        <strong>Nombre:</strong> {{ $usuario->nombre }}
    </p>
    <p>
        <strong>Apellidos:</strong> {{ $usuario->apellidos }}
    </p>
    <p>
        <strong>E-Mail:</strong> {{ $usuario->email }}
    </p>
 </div>

@endsection
```


## Guardar: Usuario.save()

Para crear un nuevo usuario, hemos de gestionar dos rutas diferentes, primero tenemos que mostrar el formulario donde introducimos toda la información, y luego hay que enviarla a otra ruta para que sea almacenada.

### Paso 1: El formulario para crear el usuario 

Le indicamos al controlador que cuando accedamos a la ruta /usuarios/create queremos que se muestre el formulario (fichero *app->Http->Controllers->UsuarioController.app*):

```php
    public function create()
    {
        // Le decimos que cargue el formulario para dar de alta un nuevo usuario
        return view('usuarios.create');
    }
```
Para la vista asociada, hay que crear el fichero resources->views->usuarios->create.blade.php

```html
@extends('app')

@section('title', 'Gestión de usuarios: Alta nuevo usuario')

@section('sidebar')
    @parent
@endsection
@section('content')
<h1>Nuevo usuario</h1>
    <hr>
     <form action="/usuarios" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="username">Nombre de usuario</label>
        <input type="text" class="form-control" id="username"  name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="email">e-mail</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos">
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>    
@endsection
```

### Paso 2: Almacenamos la información que envía el formulario

Primero modificamos el modelo porque hay que decirle a Laravel los campos que queremos se puedan rellenar nosotros "a mano" desde el modelo porque hay campos que se rellenan automáticamente (ejemplos: marcas de tiempo, autoincrements...). Fichero **app->Usuario.php**:

```php
class Usuario extends Model
{
    /* ¡¡¡IMPORTANTE!!! 
    Hay que configurar los campos que queremos se puedan rellenar nosotros "a mano"
    desde el modelo porque hay campos que se rellenan automáticamente como marcas de 
    tiempo o los autoincrements 
    */
    protected $fillable = ['username', 'password', 'nombre', 'apellidos', 'email'];
}
```

Ahora modificamos este método en el fichero app->Http->Controllers->UsuarioController.php para, primero validar los datos que nos mandan, y segundo crear el usuario:

```php
public function store(Request $request)
    {
        //Validamos que los campos son del tipo y con las características esperadas
        $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:8',
            'nombre' => 'required|min:1',
            'apellidos' => 'required|min:1',
            'email' => 'required|min:5'
        ]);
        // Creamos el usuario (username, password, nombre, apellidos, email)
        $usuario = Usuario::create(
            ['username' => $request->username,
            'password' => $request->password,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email]);
        return redirect('/usuarios/'.$usuario->id);
    }
``` 

Fíjate en el "redirect" final, que sirve para mostrar el usuario recién creado para que compruebes que son los datos correctos.

## Editar: Usuario.edit()

Para editar los datos de un usuario, venimos del botón "editar" del listado y tendremos de nuevo que hacerlo en dos pasos: 
1. Mostrar el formulario relleno con los datos del usuario para proceder a su modificación.
2. Al pulsar sobre "aceptar" hay que actualizar la base de datos, luego hay que hacer una segunda petición.

### Paso 1: Mostrar el formulario con los datos del usuario a modificar

Modificamos este método en el fichero app->Http->Controllers->UsuarioController.php para que se muestre el formulario (la vista) con los datos del usuario a cambiar:

```php
  public function edit(Usuario $usuario)
    {
        // Mostrar la vista para editar el usuario seleccionado
        return view('usuarios.edit',compact('usuario',$usuario));
    }
```

Creamos el fichero resources->views->usuarios->edit.blade.php con este contenido:

```html
@extends('app')

@section('title', 'Gestión de usuarios: Editando Usuario')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1>Editando usuario</h1>
    <hr>
     <form action="{{url('usuarios', [$usuario->id])}}" method="post">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="username">Nombre de usuario</label>
        <input type="text" value="{{$usuario->username}}" class="form-control" id="username"  name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="{{$usuario->username}}" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="email">e-mail</label>
        <input type="email" value="{{$usuario->email}}" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" value="{{$usuario->nombre}}" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" value="{{$usuario->apellidos}}" class="form-control" id="apellidos" name="apellidos">
      </div>
      
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>    
@endsection

```

**IMPORTANTE: Fíjate bien cómo los datos del usuario se rellenan automáticamente a partir del usuario que se le pasó a la vista (texto entre dobles llaves).**


### Paso 2: Actualizamos el usuario con la información que envía el formulario

Modificamos el método update() en el controlador (fichero app->Http->Controllers->UsuarioController.php):

```php
    public function update(Request $request, Usuario $usuario)
    {
        //Validamos
        $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:8',
            'nombre' => 'required|min:1',
            'apellidos' => 'required|min:1',
            'email' => 'required|min:5'
        ]);
        
        $usuario->username = $request->username;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->save();
        $request->session()->flash('message', '¡Usuario modificado correctamente!');
        return redirect('usuarios');
    }
```

Fíjate cómo actualizamos el objeto usuario con los datos del formulario, todos los campos salvo el Id y las marcas de tiempo (las que en el modelo indicamos que no se pueden actualizar, de hecho, si lo intentas cambiar, verás un error).

## Borrar: Usuario.delete()

Modificamos el método update() en el controlador (fichero app->Http->Controllers->UsuarioController.php):

```php
public function destroy(Usuario $usuario)
    {
        // Borrando sin contemplaciones...
        $usuario->delete();
        // redireccionamos al listado para que se vea que se ha borrado correctamente
        return redirect('usuarios');
    }
```