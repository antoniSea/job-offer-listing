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

        // example offer
        $offer = \App\Models\offer::create([
            'name' => 'Example Offer',
            'description' => 'Example Description',
            'contact_number' => '123456789',
            'contact_email' => 'antoniwoj@o2.pl',
            'contact_name' => 'Example Name',
            'contact_address' => 'Example Address',
            'contact_city' => 'Example City',
            'contact_street' => 'Example Street',
            'contact_postal_code' => 'Example Postal Code',
            'contact_country' => 'Example Country',
            'team_id' => $team->id,
        ]);
    }
}
