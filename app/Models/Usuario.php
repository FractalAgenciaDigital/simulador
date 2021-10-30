<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  use HasFactory;
  protected $table = "users";

  protected $fillable = [
    'id', 'name', 'email', 'password', 'nombre', 'celular', 'direccion', 'tipo_documento', 'documento', 'foto', 'sede_id', 'id_rol', 'estado'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function sede()
  {
    return $this->belongsTo(Sede::class, 'sede_id');
  }
}
