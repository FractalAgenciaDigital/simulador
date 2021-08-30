<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		return Credito::paginate(15);
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

		$credito->id_cliente = $request['id_cliente'];
		$credito->id_deudor = $request['id_deudor'];
		$credito->id_sede = $request['id_sede'];
		$credito->cant_cuotas = $request['cant_cuotas'];
		$credito->cant_cuotas_pagadas = $request['cant_cuotas_pagadas'];
		$credito->dia_limite = $request['dia_limite'];
		$credito->deudor = $request['deudor'];
		$credito->fecha_inicio = $request['fecha_inicio'];
		$credito->interes_mensual = $request['interes_mensual'];
		$credito->porcent_interes_anual = $request['porcent_interes_anual'];
		$credito->porcent_interes_mensual = $request['porcent_interes_mensual'];
		$credito->usu_crea = $request['usu_crea'];
		$credito->valor_cuota = $request['valor_cuota'];
		$credito->valor_request = $request['valor_credito'];
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
		$credito->id_cliente = $request['id_cliente'];
		$credito->id_deudor = $request['id_deudor'];
		$credito->id_sede = $request['id_sede'];
		$credito->cant_cuotas = $request['cant_cuotas'];
		$credito->cant_cuotas_pagadas = $request['cant_cuotas_pagadas'];
		$credito->dia_limite = $request['dia_limite'];
		$credito->deudor = $request['deudor'];
		$credito->fecha_inicio = $request['fecha_inicio'];
		$credito->interes_mensual = $request['interes_mensual'];
		$credito->porcent_interes_anual = $request['porcent_interes_anual'];
		$credito->porcent_interes_mensual = $request['porcent_interes_mensual'];
		$credito->usu_crea = $request['usu_crea'];
		$credito->valor_cuota = $request['valor_cuota'];
		$credito->valor_request = $request['valor_credito'];
		$credito->valor_abonado = $request['valor_abonado'];
		$credito->valor_capital = $request['valor_capital'];
		$credito->valor_interes = $request['valor_interes'];

		$credito->save();
	}


	public function camEstado(Credito $credito)
	{
		//
		$c = Credito::find($credito->id);
		// $credito->estado = '0';
		$c->estado = !$c->estado;
		$c->save();
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
}
