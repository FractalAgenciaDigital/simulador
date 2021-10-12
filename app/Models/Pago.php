<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
  use HasFactory;

  protected $table = 'pago';

  protected $fillable = [
    'tipo_deuda',
    'id_deuda',
    'valor_pago',
    'nro_cuota',
    'valor_interes',
    'valor_capital',
    'id_tercero',
    'fecha_pago'
  ];
}
