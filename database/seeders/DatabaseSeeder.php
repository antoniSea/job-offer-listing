<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create example user and team
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'antoniwoj@o2.pl',
            'password' => bcrypt('password')
        ]);

        $team = \App\Models\Team::create([
            'user_id' => $user->id,
            'name' => 'Example Team',
            'personal_team' => true
        ]);

    }
}
