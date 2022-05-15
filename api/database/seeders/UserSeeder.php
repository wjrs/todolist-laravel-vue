<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Wesley',
            'last_name' => 'Simões',
            'email' => 'wsjdeveloper@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory(5)->create();
    }
}
