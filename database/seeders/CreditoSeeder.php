<?php

namespace Database\Seeders;

use App\Models\Credito;
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
        ->count(10)
        ->create();
    }
}
