<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'Rajendra',
            'email' => 'rajendra@gmail.com',
        ]);

        listing::factory(5)->create([
            'user_id' => $user->id
        ]);

        // listing::create([
        //     'title' => 'Test Listing',
        //     'tags' => 'Laravel',
        //     'company' => 'Bhaktaour cmp',
        //     'location' => 'Bkt',
        //     'email' => 'bkt@gmail.com',
        //     'website' => 'www.example.com',
        //     'description' => 'This is a test listing.',

        // ]);

        // Listing::create([
        //     'title' => 'Test Listing 2',
        //     'tags' => 'js',
        //     'company' => 'ktm cmp',
        //     'location' => 'ktm',
        //     'email' => 'ktm@gmail.com',
        //     'website' => 'www.example.com',
        //     'description' => 'This is another test listing.',

        // ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
