<?php

namespace Database\Factories;

use App\Models\Tweet;
use Faker\Provider\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tweet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->realText(140),
            'user_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
