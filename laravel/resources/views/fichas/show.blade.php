@extends('app')

@section('title', 'Gestión de fichas')

@section('sidebar')
    @parent
@endsection

@section('content')

<h1>Mostrando ficha: {{ $ficha->id }}</h1>

 <div class="jumbotron text-center">
     <p>
         <strong>Nombre_comun:</strong> {{ $ficha->nombre_comun }} 
    </p>
    <p>
        <strong>Nombre_cientifico:</strong> {{ $ficha->nombre_cientifico }}
    </p>
    <p>
        <strong>Descripcion:</strong> {{ $ficha->descripcion }}
    </p>
    <p>
        <strong>Zona:</strong> {{ $ficha->zona }}
    </p>
    <p>
        <strong>Reino:</strong> {{ $ficha->reino }}
    </p>
    <p>
        <strong>Codigo_qr:</strong> {{ $ficha->codigo_qr }}
    </p>
    <p>
        <strong>Enlace_video:</strong> {{ $ficha->enlace_video }}
    </p>
    <p>
        <strong>Idioma:</strong> {{ $ficha->idioma }}
    </p>
 </div>

@endsection