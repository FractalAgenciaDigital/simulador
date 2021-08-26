<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  use HasFactory;

  protected $fillable = [
    'id', 'name', 'email', 'password', 'nombre', 'celular', 'direccino', 'tipo_documento', 'documento', 'foto', 'id_sede', 'id_rol', 'estado'
  ];
}
