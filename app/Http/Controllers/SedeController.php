<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Sede::paginate(10);
        return Sede::orderBy('id', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        // $sede = Sede::findOrFail($id);
        // Sede::destroy($id);
        // return redirect('sede')->with('mensaje', 'Sede eliminado correctamente');
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
        $sede = new Sede;
        $sede->create($request->all());

        // $sede->name = $request['name'];
        // $sede->email = $request['email'];
        // $sede->password = $request['password'];
        // $sede->nombre = $request['nombre'];
        // $sede->celular = $request['celular'];
        // $sede->direccion = $request['direccion'];
        // $sede->tipo_documento = $request['tipo_documento'];
        // $sede->documento = $request['documento'];
        // $sede->foto = 'undefindef';
        // $sede->id_rol = $request['id_rol'];
        // $sede->id_sede = $request['id_sede'];
        // $sede->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function show(Sede $sede)
    {
        return $sede;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function edit(Sede $sede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sede $sede)
    {
        $sede->update($request->all());

        // $sede = Sede::find($request->id);
        // $sede->name = $request['name'];
        // $sede->email = $request['email'];
        // $sede->password = $request['password'];
        // $sede->nombre = $request['nombre'];
        // $sede->celular = $request['celular'];
        // $sede->direccion = $request['direccion'];
        // $sede->tipo_documento = $request['tipo_documento'];
        // $sede->documento = $request['documento'];
        // $sede->foto = 'undefindef';
        // $sede->save();
    }


    public function camEstado(Sede $sede)
    {
        //
        $s = Sede::find($sede->id);
        // $sede->estado_sede = '0';
        $s->estado_sede = !$s->estado_sede;
        $s->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sede $sede)
    {
        $sede->delete();
    }
}
