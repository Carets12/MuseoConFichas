@extends('app')

@section('title', 'Museo de Ciencias')

@section('sidebar')
    @parent
@endsection

@section('content')
<!-- Styles -->
<style>
    .title {
        font-size: 84px;
    }

    .m-b-md {
        margin-bottom: 30px;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        
    }
</style>
    <div class="content">
                <div class="title m-b-md">
                    Museo de Ciencias
                </div>
    </div>

@endsection