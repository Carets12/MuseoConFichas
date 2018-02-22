<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('ficha/{id?}', function ($id=null) {
    if ($id==null){
        return "Listado de todas las fichas:....";
    } else {
        return view('ficha' , ['id'=>$id]);
    }
})->where('id', '[0-9]+'); 

Route::get('ficha/{name}', function ($name) {
    return "Buscando la ficha con nombre: $name";
})->where('name', '[A-Za-z]+');


Route::get('user/name/{name}/lastname/{lastname}', function ($name, $lastname){
    return "Buscando a un usuario con nombre: $name y apellido: $lastname";    
})->where(['name' => '[A-Za-z\s]+','lastname'=>'[A-Za-z\s]+']);


Route::get('layouts', function () {
    return view('child');
});


Route::resource('usuarios', 'UsuarioController');
Route::resource('fichas', 'FichasController');

