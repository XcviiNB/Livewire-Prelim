<?php

namespace Database\Seeders;

use App\Models\Gun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Gun::factory(8)->create();
    }
}
