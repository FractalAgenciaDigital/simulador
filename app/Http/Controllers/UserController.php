<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return User::paginate(10);
        return User::orderBy('id', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        // $user = User::findOrFail($id);
        // User::destroy($id);
        // return redirect('user')->with('mensaje', 'User eliminado correctamente');
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
        $user = new User;
        $user->create($request->all());

        // $user->name = $request['name'];
        // $user->email = $request['email'];
        // $user->password = $request['password'];
        // $user->nombre = $request['nombre'];
        // $user->celular = $request['celular'];
        // $user->direccion = $request['direccion'];
        // $user->tipo_documento = $request['tipo_documento'];
        // $user->documento = $request['documento'];
        // $user->foto = 'undefindef';
        // $user->id_rol = $request['id_rol'];
        // $user->id_user = $request['id_user'];
        // $user->save();
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
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        // $user = User::find($request->id);
        // $user->name = $request['name'];
        // $user->email = $request['email'];
        // $user->password = $request['password'];
        // $user->nombre = $request['nombre'];
        // $user->celular = $request['celular'];
        // $user->direccion = $request['direccion'];
        // $user->tipo_documento = $request['tipo_documento'];
        // $user->documento = $request['documento'];
        // $user->foto = 'undefindef';
        // $user->save();
    }


    public function camEstado(User $user)
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
