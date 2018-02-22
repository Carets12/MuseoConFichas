<!DOCTYPE html>
<html lang="es">
<!-- Stored in resources/views/layouts/app.blade.php -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MUSEO CIENCIAS - @yield('title')</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/raleway.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </head>
    <body>
        <div class="wrapper">
        @section('sidebar')
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Museo de Ciencias</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Fondo del Museo</p>
                    <!-- Creado por Óscar -->
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Fichas</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="/fichas">Consulta</a></li>
                            <li><a href="/fichas/create">Alta</a></li>
                            <li><a href="#">Modificación</a></li>
                            <li><a href="#">Baja</a></li>
                        </ul>
                    </li>
                    <!---->
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Usuarios</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="/usuarios/create">Crear usuario</a></li>
                            <li><a href="/usuarios">Gestión usuarios</a></li>
                        </ul>
                    </li>
                    
                    
                    <li>
                        <a href="#">Login</a>
                    </li>
                </ul>
            </nav>
        @show

            <div id="content" class="container">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <span>Activar/desactivar menú</span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">Inicio</a></li>
                                <li><a href="#">Buscador</a></li>
                                <li><a href="#">Sobre el IES</a></li>
                                <li><a href="#">Ayuda</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                @yield('content')
            </div>
        </div>
    </body>
    <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
    </script>
</html>
