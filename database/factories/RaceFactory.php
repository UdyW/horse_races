<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Race::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'race_id' => rand(100000,999999),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'runners' => rand(5,20),
            'handicap' => true,
            'trifecta' => true,
            'stewards' => 'None',
            'status' => 'Dormant',
            'revision' => 2,
            'weather' => $this->faker->sentence(3),
            'brief' => $this->faker->sentence(5)
        ];
    }
}
