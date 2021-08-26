<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		return Cliente::paginate(15);
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

		$cliente = new Cliente();
		$cliente->nombres = $request['nombres'];
		$cliente->apellidos = $request['apellidos'];
		$cliente->tipo_documento = $request['tipo_documento'];
		$cliente->nro_documento = $request['nro_documento'];
		$cliente->email = $request['email'];
		$cliente->fecha_nacimiento = $request['fecha_nacimiento'];
		$cliente->genero = $request['genero'];
		$cliente->celular1 = $request['celular1'];
		$cliente->celular2 = $request['celular2'];
		$cliente->direccion = $request['direccion'];
		$cliente->estado_civil = $request['estado_civil'];
		$cliente->lugar_trabajo = $request['lugar_trabajo'];
		$cliente->cargo = $request['cargo'];
		$cliente->independiente = $request['independiente'];
		$cliente->foto = 'undefindef';
		$cliente->save();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Cliente  $cliente
	 * @return \Illuminate\Http\Response
	 */
	public function show(Cliente $cliente)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Cliente  $cliente
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Cliente $cliente)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Cliente  $cliente
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Cliente $cliente)
	{
		$cliente = Cliente::find($request->id);
		$cliente->nombres = $request['nombres'];
		$cliente->apellidos = $request['apellidos'];
		$cliente->tipo_documento = $request['tipo_documento'];
		$cliente->nro_documento = $request['nro_documento'];
		$cliente->email = $request['email'];
		$cliente->fecha_nacimiento = $request['fecha_nacimiento'];
		$cliente->genero = $request['genero'];
		$cliente->celular1 = $request['celular1'];
		$cliente->celular2 = $request['celular2'];
		$cliente->direccion = $request['direccion'];
		$cliente->estado_civil = $request['estado_civil'];
		$cliente->lugar_trabajo = $request['lugar_trabajo'];
		$cliente->cargo = $request['cargo'];
		$cliente->independiente = $request['independiente'];
		$cliente->foto = 'undefindef';
		$cliente->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Cliente  $cliente
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Cliente $cliente)
	{
		//
	}
}
