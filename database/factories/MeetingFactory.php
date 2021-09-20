<?php

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meeting_id' => rand(100000,999999),
            'date' => $this->faker->date(),
            'country' => $this->faker->country(),
            'status' => 'Dormant',
            'course' => $this->faker->city(),
            'revision' => 1
        ];
    }
}
