<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Shikin',
            'username' => 'shikin',
            'email' => 'shikin@gmail.com',
            'password' => bcrypt('shikin')
        ]);
        Project::factory(10)->create();
    }
}
