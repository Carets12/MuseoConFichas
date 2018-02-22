<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /* ¡¡¡IMPORTANTE!!! 
    Hay que configurar los campos que queremos se puedan rellenar nosotros "a mano"
    desde el modelo porque hay campos que se rellenan automáticamente como marcas de 
    tiempo o los autoincrements 
    */
    protected $fillable = ['username', 'password', 'nombre', 'apellidos', 'email'];
}
