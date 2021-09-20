<?php

namespace Database\Factories;

use App\Models\Jockey;
use Illuminate\Database\Eloquent\Factories\Factory;

class JockeyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jockey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jockey_id' => rand(100000,999999),
            'name'  => $this->faker->name(),
            'allowence' => rand(1, 15)
        ];
    }
}
