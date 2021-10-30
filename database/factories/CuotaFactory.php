<?php

namespace Database\Factories;

use App\Models\Cuota;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuotaFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Cuota::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'credito_id' => $this->faker->numberBetween(1, 10),
      'nro_cuota' => $this->faker->numberBetween(1, 10),
      'valor' => $this->faker->randomFloat(4, 10, 60000),
      'fecha_pago' => $this->faker->date('Y-m-d'),
      'dias_mora' => $this->faker->numberBetween(1, 10),
      'valor_interes_mora' =>  $this->faker->randomFloat(4, 10, 60000),
      'valor_pago_interes' => $this->faker->randomFloat(4, 10, 60000),
      'valor_pago_capital' => $this->faker->randomFloat(4, 10, 60000),
      'registro_pago' => $this->faker->date('Y-m-d', 'now'),
      'estado' => $this->faker->boolean(),

    ];
  }
}
