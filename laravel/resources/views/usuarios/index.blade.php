@extends('app')

@section('title', 'Gestión de usuarios: Listado usuarios sistema')

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

