<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gun>
 */
class GunFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => fake()->stateAbbr().''.fake()->buildingNumber(),
            'type' => fake()->randomElement(['Pistol', 'Sub-machine Gun', 'Machine Gun', 'Shotgun', 'Sawed-off Shotgun', 'Rifle', 'Assault Rifle', 'Sniper Rifle', 'Grenade Launcher', 'Minigun']),
            'caliber' => fake()->randomElement(['.22 LR', '.380 CP', '9mm', '.40 S&W', '.45 ACP', '10mm', '5.7 FN', '.38 SPL', '.357 MAG', '5.56 / .233']),
            'country' => fake()->country()
        ];
    }
}
