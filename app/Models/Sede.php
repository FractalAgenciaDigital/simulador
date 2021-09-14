<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;
    protected $fillable = [
        'sede',
        'estado',
        'direccion',
        'nit',
        'correo_contacto',
        'representante',
        'celular_contacto'
    ];
}
