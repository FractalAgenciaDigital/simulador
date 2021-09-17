<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
	public function index()
	{
		//
		return Pago::paginate(15);
	}

	public function create($id)
	{
		//
		$pago = Pago::findOrFail($id);
		Pago::destroy($id);
		return redirect('pago')->with('mensaje', 'Pago eliminado correctamente');
	}

	public function store(Request $request)
	{

		$pago = new Pago();
		$pago->nombres = $request['nombres'];
		$pago->apellidos = $request['apellidos'];
		$pago->tipo_documento = $request['tipo_documento'];
		$pago->nro_documento = $request['nro_documento'];
		$pago->celular1 = $request['celular1'];
		$pago->celular2 = $request['celular2'];
		$pago->direccion = $request['direccion'];
    $pago->email = $request['email'];
		$pago->save();
	}

	public function show(Pago $pago)
	{
		//
	}

	public function edit(Pago $pago)
	{
		//
	}

	public function update(Request $request, Pago $pago)
	{
		$pago = Pago::find($request->id);
		$pago->nombres = $request['nombres'];
		$pago->apellidos = $request['apellidos'];
		$pago->tipo_documento = $request['tipo_documento'];
		$pago->nro_documento = $request['nro_documento'];
		$pago->celular1 = $request['celular1'];
		$pago->celular2 = $request['celular2'];
		$pago->direccion = $request['direccion'];
    $pago->email = $request['email'];
		$pago->save();
	}

	public function destroy($id)
	{
		//
	}
}
