<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExportInfo>
 */
class ExportInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'first_name'=>fake()->unique()->word(1,true),
            'last_name'=>fake()->unique()->word(1,true),
            'gender' =>fake()->randomElement(['male', 'female']),
            'email'=>fake()->email(8),
        ];
    }
}
