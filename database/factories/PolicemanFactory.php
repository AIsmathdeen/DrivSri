<?php

namespace Database\Factories;

use App\Models\Policeman;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolicemanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Policeman::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'postal_address'=>$this->faker->address,
            'dob'=>strval($this->faker->numberBetween($min = 18, $max = 90)),
            'registration_number'=>strval($this->faker->numberBetween($min = 100000, $max = 200000)),
        ];
    }
}
