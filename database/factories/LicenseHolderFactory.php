<?php

namespace Database\Factories;

use App\Models\LicenseHolder;
use Illuminate\Database\Eloquent\Factories\Factory;

class LicenseHolderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LicenseHolder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'license_no'=>strval($this->faker->numberBetween($min = 100000, $max = 200000)),
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'postal_address'=>$this->faker->address,
            'total_demerit_points'=>0,
            'mobile_no'=>$this->faker->numerify('##########'),
            'dob'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            //'status_id'=>2,
            'expiry_date'=>$this->faker->date($format = 'Y-m-d', $max = 'now')
        ];
    }
}
