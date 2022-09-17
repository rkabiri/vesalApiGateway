<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'profile_id' => '35tgfdg345443d',
            'mobile' => '09125608501',
            'last_attempt_login' => date('Y-m-d H:i:s'),
            'password' => Hash::make('12345678')
        ]);
    }
}
