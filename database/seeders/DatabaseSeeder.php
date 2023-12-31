<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'André',
            'email' => 'andre@test.com',
            'password' => Hash::make('123')
        ]);

        $this->call([
            CompanyConfigSeeder::class,
            EventSeeder::class
        ]);
    }
}
