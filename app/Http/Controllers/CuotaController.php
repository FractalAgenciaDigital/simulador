<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $creditos = Cuota::select();
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
        //
        $cuota = new Cuota();
        $cuota->credito_id = $request['credito_id'];
        $cuota->cant_cuota = $request['cant_cuota'];
        $cuota->valor = $request['valor'];
        $cuota->fecha_pago = $request['fecha_pago'];
        $cuota->dias_mora = $request['dias_mora'];
        $cuota->valor_interes_mora = $request['valor_interes_mora'];
        $cuota->valor_pago_interes = $request['valor_pago_interes'];
        $cuota->valor_pago_capital = $request['valor_pago_capital'];
        $cuota->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuota $cuota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuota $cuota)
    {
        //
        $cuota = new Cuota();
        $cuota->credito_id = $request['credito_id'];
        $cuota->cant_cuota = $request['cant_cuota'];
        $cuota->valor = $request['valor'];
        $cuota->fecha_pago = $request['fecha_pago'];
        $cuota->dias_mora = $request['dias_mora'];
        $cuota->valor_interes_mora = $request['valor_interes_mora'];
        $cuota->valor_pago_interes = $request['valor_pago_interes'];
        $cuota->valor_pago_capital = $request['valor_pago_capital'];
        $cuota->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        //
    }

    public function calcularCuotas(Request $request)
    {
        $capital = $request->valor_credito;
        $interes = $request->interes;
        $cant_cuotas = $request->cant_cuotas;

        $valor = $capital;
        $valor_pago_interes = $interes;
        $cant_cuota = $cant_cuotas;


        // var_dump($cant_cuotas);

        $fecha_pago = [];
        $fechaActual = date('Y-m-d');
        $mes_actual =  (date("d-m-Y", strtotime($fechaActual . "+ 1 months")));

        $listadoCuotas = [];
        $pagoInteres = [];
        $pagoCapital = [];
        // exit;
        $cuota =
            ($valor *
                ((pow(1 + $valor_pago_interes / 100, $cant_cuota) *
                    $valor_pago_interes) /
                    100)) /
            (pow(1 + $valor_pago_interes / 100, $cant_cuota) - 1);

        for ($i = 0; $i < $cant_cuotas; $i++) {

            $fecha_pago[$i] = (date("Y-m-d", strtotime($mes_actual . "+ $i months")));

            $pagoInteres[$i] = ($valor * ($valor_pago_interes / 100));
            $pagoCapital[$i] = $cuota - $pagoInteres[$i];
            $valor = ($valor - $pagoCapital[$i]);

            foreach ($pagoCapital as $pc) {
                $listadoCuotas[$i]['pagoCapital'] = (float) number_format($pc, 2, '.', '');
            }
            foreach ($pagoInteres as $key => $pi) {
                $listadoCuotas[$i]['pagoInteres'] = (float) number_format($pi, 2, '.', '');
            }
            foreach ($fecha_pago as $fp) {
                $listadoCuotas[$i]['fecha_pago'] = (date($fp));
                $listadoCuotas[$i]['saldo_capital'] = (float) number_format($valor, 2, '.', '');
                $listadoCuotas[$i]['valor_cuota'] = (float) number_format($cuota, 2, '.', '');
            }
            $listadoCuotas[$i]['cant_cuota'] = $i + 1;
        }

        return ['listadoCuotas' => $listadoCuotas, 'cuota' => (float) number_format($cuota, 2, '.', '')];
    }
}
