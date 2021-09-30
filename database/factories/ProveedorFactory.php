<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'nombres' => $this->faker->firstName(),
        'apellidos' => $this->faker->lastName(),
        'tipo_documento' => $this->faker->boolean(),
        'nro_documento' => $this->faker->randomNumber(),
        'celular1' => $this->faker->phoneNumber(),
        'celular2' => $this->faker->phoneNumber(),
        'direccion' => $this->faker->address(),
        'email' => $this->faker->email()
		  ];
    }
}
