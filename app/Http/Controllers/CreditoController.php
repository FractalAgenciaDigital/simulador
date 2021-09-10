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
        return Credito::paginate(15);
    }

    public function cuotas(Request $request, $id)
    {
        $credito = Credito::find($id);
        return $credito->cuotas()->get();
    }
}
