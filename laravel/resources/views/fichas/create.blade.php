@extends('app')

@section('title', 'Gestión de fichas: Alta nueva ficha')

@section('sidebar')
    @parent
@endsection
@section('content')
<h1>Nueva ficha</h1>
    <hr>
     <form action="/fichas" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="nombre_comun">Nombre comun</label>
        <input type="text" class="form-control" id="nombre_comun"  name="nombre_comun">
      </div>
      <div class="form-group">
        <label for="nombre_cientifico">Nombre cientifico</label>
        <input type="text" class="form-control" id="nombre_cientifico" name="nombre_cientifico">
      </div>
      <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion">
      </div>
      <div class="form-group">
        <label for="zona">Zona</label>
        <input type="number" class="form-control" id="zona" name="zona">
      </div>
      <div class="form-group">
        <label for="reino">Reino</label>
        <input type="number" class="form-control" id="reino" name="reino">
      </div>
      <div class="form-group">
        <label for="codigo_qr">Codigo qr</label>
        <input type="text" class="form-control" id="codigo_qr" name="codigo_qr">
      </div>
      <div class="form-group">
        <label for="enlace_video">Enlace video</label>
        <input type="text" class="form-control" id="enlace_video" name="enlace_video">
      </div>
      <div class="form-group">
        <label for="idioma">Idioma</label>
        <input type="text" class="form-control" id="idioma" name="idioma">
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