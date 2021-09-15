<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    // protected $table = 'sedes';

    protected $fillable = [
        'sede',
        'estado_sede',
        'direccion',
        'nit',
        'correo_contacto',
        'representante',
        'celular_contacto'
    ];
}
