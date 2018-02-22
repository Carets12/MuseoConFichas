<?php

namespace App\Http\Controllers;

use App\Fichas;
use Illuminate\Http\Request;

class FichasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichas = Fichas::all();
        return view('fichas.index', compact('fichas', $fichas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('fichas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre_comun' => 'required|min:5',
            'nombre_cientifico' => 'required|min:5',
            'descripcion' => 'required|min:5',
            'zona' => 'required|min:1',
            'reino' => 'required|min:2',
            'codigo_qr' => 'required|min:5',
            'enlace_video' => 'required|min:10',
            'idioma' => 'required|min:2'
        ]);
        //
        $ficha = Fichas::create(
            ['nombre_comun' => $request->nombre_comun,
            'nombre_cientifico' => $request->nombre_cientifico,
            'descripcion' => $request->descripcion,
            'zona' => $request->zona,
            'reino' => $request->reino,
            'codigo_qr' => $request->codigo_qr,
            'enlace_video' => $request->enlace_video,
            'idioma' => $request->idioma]);
        return redirect('/fichas/'.$ficha->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fichas  $fichas
     * @return \Illuminate\Http\Response
     */
    public function show(Fichas $ficha)
    {
        //
        return view('fichas.show',compact('ficha',$ficha));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fichas  $fichas
     * @return \Illuminate\Http\Response
     */
    public function edit(Fichas $fichas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fichas  $fichas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fichas $fichas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fichas  $fichas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fichas $fichas)
    {
        //
    }
}
