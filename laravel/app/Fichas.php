<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichas extends Model
{
    //
    protected $fillable = ['nombre_comun', 'nombre_cientifico', 'descripcion', 'zona', 'reino', 'codigo_qr', 'enlace_video', 'idioma'];
}
