<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  use HasFactory;

  protected $fillable = [
    'nombres',
    'apellidos',
    'tipo_documento',
    'nro_documento',
    'fecha_nacimiento',
    'email',
    'genero',
    'celular1',
    'celular2',
    'direccion',
    'estado_civil',
    'lugar_trabajo',
    'cargo',
    'independiente',
    'foto'
  ];

  public function creditos()
  {
    return $this->hasMany(Credito::class);
  }
}
