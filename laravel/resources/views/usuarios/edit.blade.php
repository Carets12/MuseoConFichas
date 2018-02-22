@extends('app')

@section('title', 'Gestión de usuarios: Editando usuario')

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

