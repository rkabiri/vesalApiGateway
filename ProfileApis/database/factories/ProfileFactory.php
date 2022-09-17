<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'mobile' => $this->faker->e164PhoneNumber(),
            'age' => $this->faker->numberBetween(18,50),
            'last_login_ip' => $this->faker->ipv4,
            'lat' => $this->faker->latitude('35.76234427321403','35.78564181505302'), // * START & END LATITUDE OF LOCATION
            'lng' => $this->faker->longitude('51.23090877333538','51.49334018354908'), // * START & END LATITUDE OF LOCATION
        ];
    }
}
