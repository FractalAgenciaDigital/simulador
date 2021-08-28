<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
  use HasFactory;


  protected $fillable = [
    'credito_id',
    'nro_cuota',
    'valor',
    'fecha_pago',
    'dias_mora',
    'valor_interes_mora',
    'valor_pago_interes',
    'valor_pago_capital'
  ];
}
