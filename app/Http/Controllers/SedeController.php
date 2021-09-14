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
    public function index(Request $request)
    {
        $sedes = Sede::select();
        if ($request->sede && ($request->sede != '')) {
            $sedes  =     $sedes->where('sede', 'LIKE', "%$request->sede%")
                ->orWhere('nit', 'LIKE', "%$request->sede%")
                ->orWhere('representante', 'LIKE', "%$request->sede%")
                ->orWhere('correo_contacto', 'LIKE', "%$request->sede%");
        }
        $sedes = $sedes->paginate(20);

        return $sedes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $sede = Sede::findOrFail($id);
        Sede::destroy($id);
        return redirect('sede')->with('mensaje', 'Sede eliminado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $sede = new Sede();
        $sede->sede = $request['sede'];
        $sede->estado = $request['estado'];
        $sede->direccion = $request['direccion'];
        $sede->email = $request['email'];
        $sede->nit = $request['nit'];
        $sede->correo_contacto = $request['correo_contacto'];
        $sede->representante = $request['representante'];
        $sede->celular_contacto = $request['celular_contacto'];

        $sede->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function show(Sede $sede)
    {
        //
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
        $sede = Sede::find($request->id);
        $sede->sede = $request['sede'];
        $sede->estado = $request['estado'];
        $sede->direccion = $request['direccion'];
        $sede->email = $request['email'];
        $sede->nit = $request['nit'];
        $sede->correo_contacto = $request['correo_contacto'];
        $sede->representante = $request['representante'];
        $sede->celular_contacto = $request['celular_contacto'];
        $sede->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sede  $sede
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function cambiarEstado(Sede $sede)
    {
        //
        $sd = Sede::find($sede->id);
        $sd->estado = !$sd->estado;
        $sd->save();
    }
}
