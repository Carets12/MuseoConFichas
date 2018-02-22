@extends('app')

@section('title', 'Gestión de usuarios: Detalle del usuario')

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