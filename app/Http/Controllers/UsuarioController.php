<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = Usuario::select();
        if ($request->usuario && ($request->usuario != '')) {
            $usuarios  =     $usuarios->where('documento', 'LIKE', "%$request->usuario%")
                ->orWhere('nombres', 'LIKE', "%$request->usuario%")
                ->orWhere('email', 'LIKE', "%$request->usuario%");
        }
        $usuarios = $usuarios->paginate(5);

        return $usuarios;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $usuario = Usuario::findOrFail($id);
        Usuario::destroy($id);
        return redirect('usuario')->with('mensaje', 'Usuario eliminado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->email = $request['email'];
        $usuario->password = $request['password'];
        $usuario->nombres = $request['nombres'];
        $usuario->apellidos = $request['apellidos'];
        $usuario->celular = $request['celular'];
        $usuario->direccion = $request['direccion'];
        $usuario->tipo_documento = $request['tipo_documento'];
        $usuario->documento = $request['documento'];
        $usuario->foto = 'undefindef';
        $usuario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario = Usuario::find($request->id);
        
        $usuario->email = $request['email'];
        $usuario->password = $request['password'];
        $usuario->nombres = $request['nombres'];
        $usuario->apellidos = $request['apellidos'];
        $usuario->celular = $request['celular'];
        $usuario->direccion = $request['direccion'];
        $usuario->tipo_documento = $request['tipo_documento'];
        $usuario->documento = $request['documento'];
        $usuario->foto = 'undefindef';
        $usuario->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function cambiarEstado(Usuario $usuario)
    {
        //
        $u = Usuario::find($usuario->id);
        $u->estado = !$u->estado;
        $u->save();
    }
}
