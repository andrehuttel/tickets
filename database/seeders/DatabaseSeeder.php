<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\CompanyConfig;
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

        Company::create([
            'host' => 'tickets.test',
        ]);

        $company = Company::where('host', 'tickets.test')->first();
        if ($company) {
            CompanyConfig::create([
                'company_id' => $company->id,
                'logo' => 'example.png',
                'address' => '123 Main St',
                'fone' => '555-123-4567',
                'color_menu' => 'blue',
                'color_background' => 'white',
            ]);
        }

        Company::create([
            'host' => 'andre.tickets.test',
        ]);

        $company = Company::where('host', 'andre.tickets.test')->first();
        if ($company) {
            CompanyConfig::create([
                'company_id' => $company->id,
                'logo' => 'example1.png',
                'address' => '123 Main St',
                'fone' => '555-123-9876',
                'color_menu' => 'green',
                'color_background' => 'white',
            ]);
        }

        Company::create([
            'host' => 'cliente1.com',
        ]);

        $company2 = Company::where('host', 'cliente1.com')->first();
        if ($company2) {
            CompanyConfig::create([
                'company_id' => $company2->id,
                'logo' => 'example2.png',
                'address' => '456 Client St',
                'fone' => '555-987-6543',
                'color_menu' => 'yellow',
                'color_background' => 'white',
            ]);
        }
    }
}
