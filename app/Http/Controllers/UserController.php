<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return User::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->tipo_documento = $request->nombres;
        $usuario->documento = $request->documento;
        $usuario->foto = $request->foto;
        if ($request->estado) {
            $usuario->estado = $request->estado;
        }
        $usuario->direccion = $request->direccion;
        $usuario->celular = $request->celular;
        $usuario->rol_id = $request->rol_id;
        $usuario->sede_id = $request->sede_id;
        $usuario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        if ($request->password != '') {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->tipo_documento = $request->nombres;
        $usuario->documento = $request->documento;
        $usuario->foto = $request->foto;
        if ($request->estado) {
            $usuario->estado = $request->estado;
        }
        $usuario->direccion = $request->direccion;
        $usuario->celular = $request->celular;
        $usuario->rol_id = $request->rol_id;
        $usuario->sede_id = $request->sede_id;
        $usuario->save();
    }


    public function cambiarEstado(User $user)
    {
        //
        $u = User::find($user->id);
        $u->estado = !$u->estado;
        $u->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
