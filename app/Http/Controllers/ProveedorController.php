<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
	public function index()
	{
		//
		return Proveedor::paginate(15);
	}

	public function create($id)
	{
		//
		$proveedor = Proveedor::findOrFail($id);
		Proveedor::destroy($id);
		return redirect('proveedor')->with('mensaje', 'Proveedor eliminado correctamente');
	}

	public function store(Request $request)
	{

		$proveedor = new Proveedor();
		$proveedor->nombres = $request['nombres'];
		$proveedor->apellidos = $request['apellidos'];
		$proveedor->tipo_documento = $request['tipo_documento'];
		$proveedor->nro_documento = $request['nro_documento'];
		$proveedor->celular1 = $request['celular1'];
		$proveedor->celular2 = $request['celular2'];
		$proveedor->direccion = $request['direccion'];
    $proveedor->email = $request['email'];
		$proveedor->save();
	}

	public function show(Proveedor $proveedor)
	{
		//
	}

	public function edit(Proveedor $proveedor)
	{
		//
	}

	public function update(Request $request, Proveedor $proveedor)
	{
		$proveedor = Proveedor::find($request->id);
		$proveedor->nombres = $request['nombres'];
		$proveedor->apellidos = $request['apellidos'];
		$proveedor->tipo_documento = $request['tipo_documento'];
		$proveedor->nro_documento = $request['nro_documento'];
		$proveedor->celular1 = $request['celular1'];
		$proveedor->celular2 = $request['celular2'];
		$proveedor->direccion = $request['direccion'];
    $proveedor->email = $request['email'];
		$proveedor->save();
	}

	public function cambiarEstado(Proveedor $proveedor)
	{
		//
		$c = Proveedor::find($proveedor->id);
		// $proveedor->activo = '0';
		$c->activo = !$c->activo;
		$c->save();
	}
	public function destroy($id)
	{
		//
	}
}
