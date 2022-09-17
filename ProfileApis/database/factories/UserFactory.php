<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'f_name' => $this->faker->firstName,
            'l_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(18,50),
            'last_login_ip' => $this->faker->ipv4,
            'lat' => $this->faker->latitude('35.76234427321403','35.78564181505302'), // * START & END LATITUDE OF LOCATION
            'lng' => $this->faker->longitude('51.23090877333538','51.49334018354908'), // * START & END LATITUDE OF LOCATION
        ];
    }
}
