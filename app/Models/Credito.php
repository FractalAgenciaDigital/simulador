<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = 'creditos';

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
        'interes',
        'porcentaje_interes_anual',
        'porcentaje_interes_mensual',
        'usu_crea',
        'valor_cuota',
        'valor_credito',
        'valor_abonado',
        'valor_capital',
        'valor_interes',
    ];
 
    protected $with = [
        'cliente'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function deudor()
    {
        return $this->belongsTo(Cliente::class, 'deudor_id');
    }

    public function asesor()
    {
        return $this->belongsTo(User::class, 'usu_crea');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }
    public function cuotas()
    {
        return $this->hasMany(Cuota::class, 'credito_id');
    }
}
