<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  use HasFactory;

  protected $table = 'proveedores';

  protected $fillable = [
    'nombres',
    'apellidos',
    'tipo_documento',
    'nro_documento',
    'celular1',
    'celular2',
    'direccion',
    'email',
    'estado'
  ];
}
