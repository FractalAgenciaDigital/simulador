<?php

namespace Database\Seeders;

use App\Models\Credito;
use App\Models\Cuota;
use Database\Factories\CuotaFactory;
use Illuminate\Database\Seeder;

class CreditoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credito::factory()
        ->has(Cuota::factory()->count(3))
        ->count(10)
        ->create();
    }
}
