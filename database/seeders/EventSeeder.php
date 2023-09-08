<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('host', 'tickets.test')->first();
        if ($company) {
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento de Amostra do company '. $company->host,
                'place' => 'Local de Amostra do company '. $company->host,
                'date' => '2023-10-10',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 2 de Amostra do company '. $company->host,
                'place' => 'Local 2 de Amostra do company '. $company->host,
                'date' => '2023-10-11',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 2 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 3 de Amostra do company '. $company->host,
                'place' => 'Local 3 de Amostra do company '. $company->host,
                'date' => '2023-10-12',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 3 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 4 de Amostra do company '. $company->host,
                'place' => 'Local 4 de Amostra do company '. $company->host,
                'date' => '2023-10-13',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 4 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 5 de Amostra do company '. $company->host,
                'place' => 'Local 5 de Amostra do company '. $company->host,
                'date' => '2023-10-14',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 5 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 6 de Amostra do company '. $company->host,
                'place' => 'Local 6 de Amostra do company '. $company->host,
                'date' => '2023-10-15',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 6 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
        }

        $company = Company::where('host', 'andre.tickets.test')->first();
        if ($company) {
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento de Amostra do company '. $company->host,
                'place' => 'Local de Amostra do company '. $company->host,
                'date' => '2023-10-10',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 2 de Amostra do company '. $company->host,
                'place' => 'Local 2 de Amostra do company '. $company->host,
                'date' => '2023-10-11',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 2 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 3 de Amostra do company '. $company->host,
                'place' => 'Local 3 de Amostra do company '. $company->host,
                'date' => '2023-10-12',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 3 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 4 de Amostra do company '. $company->host,
                'place' => 'Local 4 de Amostra do company '. $company->host,
                'date' => '2023-10-13',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 4 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 5 de Amostra do company '. $company->host,
                'place' => 'Local 5 de Amostra do company '. $company->host,
                'date' => '2023-10-14',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 5 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 6 de Amostra do company '. $company->host,
                'place' => 'Local 6 de Amostra do company '. $company->host,
                'date' => '2023-10-15',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 6 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
        }

        $company = Company::where('host', 'cliente1.com')->first();
        if ($company) {
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento de Amostra do company '. $company->host,
                'place' => 'Local de Amostra do company '. $company->host,
                'date' => '2023-10-10',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 2 de Amostra do company '. $company->host,
                'place' => 'Local 2 de Amostra do company '. $company->host,
                'date' => '2023-10-11',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 2 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 3 de Amostra do company '. $company->host,
                'place' => 'Local 3 de Amostra do company '. $company->host,
                'date' => '2023-10-12',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 3 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 4 de Amostra do company '. $company->host,
                'place' => 'Local 4 de Amostra do company '. $company->host,
                'date' => '2023-10-13',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 4 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 5 de Amostra do company '. $company->host,
                'place' => 'Local 5 de Amostra do company '. $company->host,
                'date' => '2023-10-14',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 5 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 6 de Amostra do company '. $company->host,
                'place' => 'Local 6 de Amostra do company '. $company->host,
                'date' => '2023-10-15',
                'date_opening' => now(),
                'image' => '/images/sample-event.jpg',
                'description' => 'Este é um evento de amostra 6 para testar o sistema do company '. $company->host,
                'map' => 'Link do mapa do evento',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
        }
    }
}
