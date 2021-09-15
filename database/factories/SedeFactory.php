<?php

namespace Database\Factories;

use App\Models\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

class SedeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sede::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sede' => $this->faker->name(),
            'direccion' => $this->faker->address(),
            'nit' => $this->faker->ean13(),
            'correo_contacto' => $this->faker->email(),
            'representante' => $this->faker->lastName(),
            'celular_contacto' => $this->faker->phoneNumber()
        ];
    }
}
