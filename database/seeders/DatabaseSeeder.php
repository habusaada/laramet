<?php

namespace Database\Seeders;
use App\Models\Profile;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(PermissionsStarterSeeder::class);
        User::withoutEvents(function () {
            User::factory()->count(20)->withProfile()->create();
        });

    }
}
