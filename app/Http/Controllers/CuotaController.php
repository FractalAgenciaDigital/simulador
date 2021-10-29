<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $creditos = Cuota::select();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cuota = new Cuota();
        $cuota->credito_id = $request['credito_id'];
        $cuota->nro_cuota = $request['nro_cuota'];
        $cuota->valor = $request['valor'];
        $cuota->fecha_pago = $request['fecha_pago'];
        $cuota->dias_mora = $request['dias_mora'];
        $cuota->valor_interes_mora = $request['valor_interes_mora'];
        $cuota->valor_pago_interes = $request['valor_pago_interes'];
        $cuota->valor_pago_capital = $request['valor_pago_capital'];
        $cuota->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuota $cuota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuota $cuota)
    {
        //
        $cuota = new Cuota();
        $cuota->credito_id = $request['credito_id'];
        $cuota->nro_cuota = $request['nro_cuota'];
        $cuota->valor = $request['valor'];
        $cuota->fecha_pago = $request['fecha_pago'];
        $cuota->dias_mora = $request['dias_mora'];
        $cuota->valor_interes_mora = $request['valor_interes_mora'];
        $cuota->valor_pago_interes = $request['valor_pago_interes'];
        $cuota->valor_pago_capital = $request['valor_pago_capital'];
        $cuota->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        //
    }
}
