<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sede;
use App\Models\Credito;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $creditos = Credito::select();
        $clientes = Cliente::select();
        $sedes = Sede::select();



        if ($request->credito && ($request->credito != '')) {
            $creditos  =     $creditos->where('cliente_id', 'LIKE', "%$request->credito%")
                ->orWhere('id_deudor', 'LIKE', "%$request->credito%")
                ->orWhere('sede_id', 'LIKE', "%$request->credito%");
        }

        // if ($request->cliente && ($request->cliente != '')) {
        //     $clientes = $clientes->leftjoin('clientes as c', 'c.id', 'creditos.id_cliente')
        //         ->select('creditos.*', 'c.nombres as cliente');

        //     $clientes  = $clientes->where('cliente_id', 'LIKE', "%$request->credito%")
        //         ->orWhere('id_deudor', 'LIKE', "%$request->credito%")
        //         ->orWhere('sede_id', 'LIKE', "%$request->credito%");
        // }
        $creditos = $creditos->paginate(20);
        // $clientes = $clientes->paginate(20);

        return $creditos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $credito = Credito::findOrFail($id);
        Credito::destroy($id);
        return redirect('credito')->with('mensaje', 'Credito eliminado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $credito = new Credito();
        $credito->cliente_id = $request['cliente_id'];
        $credito->id_deudor = $request['id_deudor'];
        $credito->sede_id = $request['sede_id'];
        $credito->cant_cuotas = $request['cant_cuotas'];
        $credito->cant_cuotas_pagadas = $request['cant_cuotas_pagadas'];
        $credito->dia_limite = $request['dia_limite'];
        $credito->estado = $request['estado'];
        $credito->fecha_inicio = $request['fecha_inicio'];
        $credito->interes_mensual = $request['interes_mensual'];
        $credito->porcent_interes_anual = $request['porcent_interes_anual'];
        $credito->porcent_interes_mensual = $request['porcent_interes_mensual'];
        $credito->usu_crea = $request['usu_crea'];
        $credito->valor_cuota = $request['valor_cuota'];
        $credito->valor_credito = $request['valor_credito'];
        $credito->valor_abonado = $request['valor_abonado'];
        $credito->valor_capital = $request['valor_capital'];
        $credito->valor_interes = $request['valor_interes'];
        $credito->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function show(Credito $credito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function edit(Credito $credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credito $credito)
    {
        $credito = Credito::find($request->id);
        $credito->cliente_id = $request['cliente_id'];
        $credito->id_deudor = $request['id_deudor'];
        $credito->sede_id = $request['sede_id'];
        $credito->cant_cuotas = $request['cant_cuotas'];
        $credito->cant_cuotas_pagadas = $request['cant_cuotas_pagadas'];
        $credito->dia_limite = $request['dia_limite'];
        $credito->estado = $request['estado'];
        $credito->fecha_inicio = $request['fecha_inicio'];
        $credito->interes_mensual = $request['interes_mensual'];
        $credito->porcent_interes_anual = $request['porcent_interes_anual'];
        $credito->porcent_interes_mensual = $request['porcent_interes_mensual'];
        $credito->usu_crea = $request['usu_crea'];
        $credito->valor_cuota = $request['valor_cuota'];
        $credito->valor_credito = $request['valor_credito'];
        $credito->valor_abonado = $request['valor_abonado'];
        $credito->valor_capital = $request['valor_capital'];
        $credito->valor_interes = $request['valor_interes'];
        $credito->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function cambiarEstado(Credito $credito)
    {
        //
        $cre = Credito::find($credito->id);
        $cre->estado = !$cre->estado;
        $cre->save();
    }

    public function cuotas(Request $request, $id)
    {
        $credito = Credito::find($id);
        return $credito->cuotas()->get();
    }
}
