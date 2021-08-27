<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'deudor_id',
        'sede_id',
        'cant_cuotas',
        'cant_cuotas_pagadas',
        'dia_limite',
        'deudor',
        'estado',
        'fecha_inicio',
        'interes_mensual',
        'porcentaje_interes_anual',
        'porcentaje_interes_mensual',
        'usu_crea',
        'valor_cuota',
        'valor_credito',
        'valor_abonado',
        'valor_capital',
        'valor_interes',
    ];
}
