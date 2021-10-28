<?php

namespace Database\Factories;

use App\Models\Credito;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Credito::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => $this->faker->numberBetween(1, 10),
            'deudor_id' => $this->faker->numberBetween(1, 10),
            'sede_id' => $this->faker->numberBetween(1, 3),
            'cant_cuotas' => $this->faker->randomNumber(),
            'cant_cuotas_pagadas' => $this->faker->randomNumber(),
            'dia_limite' => $this->faker->randomNumber(),
            'deudor' => $this->faker->boolean(),
            'estado' => $this->faker->boolean(),
            'fecha_inicio' => $this->faker->date('Y-m-d'),
            'interes' => $this->faker->randomNumber(),
            'porcentaje_interes_anual' => $this->faker->randomNumber(),
            'porcentaje_interes_mensual' => $this->faker->randomNumber(),
            'usu_crea' => $this->faker->numberBetween(1, 3),
            'valor_cuota' => $this->faker->randomNumber(),
            'valor_credito' => $this->faker->randomNumber(),
            'valor_abonado' => $this->faker->randomNumber(),
            'valor_capital' => $this->faker->randomNumber(),
            'valor_interes' => $this->faker->randomNumber(),
        ];
    }
}
