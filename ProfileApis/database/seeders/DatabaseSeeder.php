<?php

namespace Database\Seeders;

use App\Models\Profile;
use Database\Factories\ProfileFactory;
use Database\Factories\UserFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Profile::factory(10)->create(); // * MAKE FAKE DATA FOR PROFILE
    }
}
