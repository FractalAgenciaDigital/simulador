<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  use HasFactory;
  protected $table = 'users';

  protected $fillable = [
    'name', 'email', 'password', 'nombre', 'celular', 'direccion', 'tipo_documento', 'documento', 'foto', 'id_sede', 'id_rol', 'estado'
  ];
}
