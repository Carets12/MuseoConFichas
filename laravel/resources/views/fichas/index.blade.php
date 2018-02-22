@extends('app')

@section('title', 'Gestión de fichas')

@section('sidebar')
    @parent
@endsection

@section('content')

 <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre_Comun</th>
              <th scope="col">Nombre_Cientifico</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Zona</th>
              <th scope="col">Reino</th>
              <th scope="col">Codigo-qr</th>
              <th scope="col">Enlace_video</th>
              <th scope="col">Idioma</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fichas as $ficha)
            <tr>
              <th scope="row">{{$ficha->id}}</th>
              <td><a href="/fichas/{{$ficha->id}}">{{$ficha->nombre_comun}}</a></td>
              <td>{{$ficha->nombre_cientifico}}</td>
              <td>{{$ficha->descripcion}}</td>
              <td>{{$ficha->zona}}</td>              
              <td>{{$ficha->reino}}</td>              
              <td>{{$ficha->codigo_qr}}</td>              
              <td>{{$ficha->enlace_video}}</td>              
              <td>{{$ficha->idioma}}</td>              
              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('fichas/' . $ficha->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('fichas', [$ficha->id])}}" method="POST">
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