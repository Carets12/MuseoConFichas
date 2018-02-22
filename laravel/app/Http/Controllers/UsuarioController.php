<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Guarda en el array $usuarios la lista de todos los que haya en la BBDD
        // es como un findAll()
        $usuarios = Usuario::all();
        return view('usuarios.index',compact('usuarios',$usuarios));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Le decimos que cargue el formulario para dar de alta un nuevo usuario
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
        return view('usuarios.show',compact('usuario',$usuario));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        // Mostrar la vista para editar el usuario seleccionado
        return view('usuarios.edit',compact('usuario',$usuario));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        // Borrando sin contemplaciones...
        $usuario->delete();
        // redireccionamos al listado para que se vea que se ha borrado correctamente
        return redirect('usuarios');
    }
}
