<?php

namespace App\Http\Controllers;

use App\Models\Simulador;
use Illuminate\Http\Request;

class SimuladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Simulador::paginate(10);
        // return Simulador::orderBy('id', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $usuario = Simulador::findOrFail($id);
        Simulador::destroy($id);
        return redirect('usuario')->with('mensaje', 'Simulador eliminado correctamente');
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
        $usuario = new Simulador;
        // $usuario->create($request->all());

        $usuario->name = $request['name'];
        $usuario->email = $request['email'];
        $usuario->password = $request['password'];
        $usuario->nombre = $request['nombre'];
        $usuario->celular = $request['celular'];
        $usuario->direccion = $request['direccion'];
        $usuario->tipo_documento = $request['tipo_documento'];
        $usuario->documento = $request['documento'];
        $usuario->foto = 'undefindef';
        $usuario->id_rol = $request['id_rol'];
        $usuario->id_sede = $request['id_sede'];
        $usuario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simulador  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Simulador $usuario)
    {
        // return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simulador  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Simulador $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simulador  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simulador $usuario)
    {
        // $usuario->update($request->all());


        $usuario = Simulador::find($request->id);
        $usuario->name = $request['name'];
        $usuario->email = $request['email'];
        $usuario->password = $request['password'];
        $usuario->nombre = $request['nombre'];
        $usuario->celular = $request['celular'];
        $usuario->direccion = $request['direccion'];
        $usuario->tipo_documento = $request['tipo_documento'];
        $usuario->documento = $request['documento'];
        $usuario->foto = 'undefindef';
        $usuario->id_rol = $request['id_rol'];
        $usuario->id_sede = $request['id_sede'];
        $usuario->save();
    }


    public function camEstado(Simulador $usuario)
    {
        //
        $u = Simulador::find($usuario->id);
        // $usuario->estado = '0';
        $u->estado = !$u->estado;
        $u->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simulador  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simulador $usuario)
    {
        $usuario->delete();
    }
}
