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
                'key' => 'logo',
                'value' => '/images/logo-gototem.png',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'primary_color',
                'value' => '#22c55e',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'second_color',
                'value' => '#e7e5e4',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'fone',
                'value' => '(11) 55555-5555',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'address',
                'value' => 'Rua Teste, 123 - Centro - São Paulo/SP',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'title',
                'value' => 'GOTOTEM TICKETS',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner1',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+1',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner2',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+2',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner3',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+3',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner4',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+4',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner5',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+5',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'is_active',
                'value' => '1',
            ]);
        }

        Company::create([
            'host' => 'andre.tickets.test',
        ]);

        $company = Company::where('host', 'andre.tickets.test')->first();
        if ($company) {
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'logo',
                'value' => '/images/logo-gototem.png',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'primary_color',
                'value' => '#2563eb',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'second_color',
                'value' => '#e7e5e4',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'fone',
                'value' => '(11) 66666-6666',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'address',
                'value' => 'Rua Teste1, 123 - Centro - São Paulo/SP',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'title',
                'value' => 'ANDRE TICKETS',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner1',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+11',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner2',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+22',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner3',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+33',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner4',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+44',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner5',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+55',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'is_active',
                'value' => '1',
            ]);
        }

        Company::create([
            'host' => 'cliente1.com',
        ]);

        $company = Company::where('host', 'cliente1.com')->first();
        if ($company) {
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'logo',
                'value' => '',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'primary_color',
                'value' => '#ff0000',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'second_color',
                'value' => '#e7e5e4',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'fone',
                'value' => '(11) 77777-7777',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'address',
                'value' => 'Rua Teste2, 123 - Centro - São Paulo/SP',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'title',
                'value' => 'CLIENTE1 TICKETS',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner1',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+111',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner2',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+222',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner3',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+333',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner4',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+444',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'banner5',
                'value' => 'https://via.placeholder.com/728x90.png?text=Banner+555',
            ]);
            CompanyConfig::create([
                'company_id' => $company->id,
                'key' => 'is_active',
                'value' => '1',
            ]);
        }
    }
}
