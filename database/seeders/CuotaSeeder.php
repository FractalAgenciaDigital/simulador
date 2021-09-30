<?php

namespace Database\Seeders;

use App\Models\Cuota;
use Illuminate\Database\Seeder;

class CuotaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Cuota::factory()
			->count(20)
			->create();
	}
}
