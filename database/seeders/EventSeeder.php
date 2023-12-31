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
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-10',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra para testar o sistema do company '. $company->host,
                'description_append' => '<p><strong>Informações Extras: </strong></p><br><h2>'. $company->host.'</h2>',
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 2 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-11',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 2 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 3 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-12',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 3 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 4 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-13',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 4 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 5 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-14',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 5 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 6 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-15',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 6 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
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
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-10',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 2 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-11',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 2 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 3 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-12',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 3 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 4 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-13',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 4 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 5 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-14',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 5 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 6 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-15',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 6 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
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
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-10',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 2 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-11',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 2 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 3 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-12',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 3 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 4 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-13',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 4 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 5 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-14',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 5 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
            Event::create([
                'company_id' => $company->id,
                'name' => 'Evento 6 de Amostra do company '. $company->host,
                'place' => 'Joinville Square Garden',
                'place_address' => 'Av. Santos Dumont - Distrito Industrial, Joinville - SC, 89223-001',
                'date' => '2023-10-15',
                'date_opening' => now(),
                'image' => '/images/simple-event.jpg',
                'description' => 'Este é um evento de amostra 6 para testar o sistema do company '. $company->host,
                'map' => 'https://goo.gl/maps/2pXCEjxv5LpyXhBA9',
                'organizer' => 'LAJE (Liga das Atléticas de Joinville)',
                'organizer_logo' => 'https://scontent.fjoi7-1.fna.fbcdn.net/v/t39.30808-6/326671537_729794265228553_3984050931007951786_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=a2f6c7&_nc_ohc=S6-bmLJ1WIQAX-Stl6j&_nc_ht=scontent.fjoi7-1.fna&oh=00_AfAQ5sFEqgJ9oJcKe2yC7u2h57x-Mz0aJCydCZp3orXs7w&oe=6508C0B8',
                'organizer_instagram' => 'https://www.instagram.com/lajejoinville/',
                'organizer_facebook' => 'https://www.facebook.com/lajejoinville',
                'classification' => '18+',
                'link_share_whatsapp' => 'Link de compartilhamento no WhatsApp',
                'link_share_facebook' => 'Link de compartilhamento no Facebook',
                'link_share_twitter' => 'Link de compartilhamento no Twitter',
            ]);
        }
    }
}
