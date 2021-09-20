<?php

namespace Database\Factories;

use App\Models\Horse;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Horse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'horse_id' => rand(100000,999999),
            'bred' => $this->faker->cityPrefix(),
            'status' => "Runner",
            'cloth_number' => rand(1,20),
            'weight'    => rand(1,20),
            'weight_text' => $this->faker->sentence(3)
        ];
    }
}
