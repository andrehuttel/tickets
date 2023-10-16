<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanyConfig;
use App\Models\Event;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CompanyService
{
    public function getCompany($host)
    {
        try {
            $fl_use_cache = 0;
            $company = Company::where('host', $host)->orWhere('host_generated', $host)->first();
            if ($company) {
                $fl_use_cache = $company->fl_use_cache;
            }

            if ($fl_use_cache == 1) {
                $cachePattern = 'company_' . $company->host;
            
                $cacheDriver = config('cache.default');

                if ($cacheDriver === 'redis') {
                    $keys = Cache::store('redis')->getStore()->connection()->keys('*' . $cachePattern . '*');
                    if($keys){
                        foreach ($keys as $key) {
                            $keyValue = explode(':', $key);
                            Cache::store('redis')->forget($keyValue[1]);
                        }

                        Log::info("Cache foi limpado com sucesso no company: {$company->id}");
                    }
                } elseif ($cacheDriver === 'memcached') {
                    $keys = Cache::store('memcached')->getStore()->getMemcached()->getAllKeys();
                    if ($keys) {
                        $matchingKeys = preg_grep('/' . $cachePattern . '/', $keys);
                    }
                    if ($matchingKeys) {
                        foreach ($matchingKeys as $key) {
                            Cache::store('memcached')->forget($key);
                        }

                        Log::info("Cache foi limpado com sucesso no company: {$company->id}");
                    }
                }
            }

            $apiService = new ApiService();
            $apiData = $apiService->getData(env('API_URL').'/place', env('API_USERNAME'), env('API_PASSWORD'), null);

            if ($apiData) {
                foreach ($apiData as $key => $value) {
                    $company = Company::where('id', $value['id'])->first();
                    if ($company) {
                        $company->update([
                            'name' => $value['name'], 
                            'cnpj' => $value['cnpj'],
                            'host' => $value['store_host'],
                            'fl_use_cache' => isset($value['fl_use_cache']) ? $value['fl_use_cache'] : null,
                        ]);
                        Log::info("Empresa atualizada: {$company->name}");
                    } else {
                        Company::create([
                            'id' => $value['id'],
                            'name' => $value['name'], 
                            'cnpj' => $value['cnpj'],
                            'host' => $value['store_host'],
                            'fl_use_cache' => isset($value['fl_use_cache']) ? $value['fl_use_cache'] : null,
                        ]);
                        Log::info("Nova empresa criada: {$value['name']}");
                    }
                }
                return response()->json(['message' => 'Dados da empresa atualizados com sucesso'], 200);
            }

            return response()->json(['error' => 'Nenhum dado da empresa recebido da API'], 400);
        } catch (\Exception $e) {
            Log::error('Erro ao acessar a API: ' . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao acessar a API'], 500);
        }
    }

    public function getConfig($id)
    {
        try {
            $company = Company::where('id', $id)->first();
            $fl_use_cache = $company->fl_use_cache;
            if ($fl_use_cache == 1) {
                $cachePattern = 'company_' . $company->host;
            
                $cacheDriver = config('cache.default');

                if ($cacheDriver === 'redis') {
                    $keys = Cache::store('redis')->getStore()->connection()->keys('*' . $cachePattern . '*');
                    if($keys){
                        foreach ($keys as $key) {
                            $keyValue = explode(':', $key);
                            Cache::store('redis')->forget($keyValue[1]);
                        }

                        Log::info("Cache foi limpado com sucesso no company: {$id}");
                    }
                } elseif ($cacheDriver === 'memcached') {
                    $keys = Cache::store('memcached')->getStore()->getMemcached()->getAllKeys();
                    if ($keys) {
                        $matchingKeys = preg_grep('/' . $cachePattern . '/', $keys);
                    }
                    dd($matchingKeys);
                    if ($matchingKeys) {
                        dd($matchingKeys);
                        foreach ($matchingKeys as $key) {
                            Cache::store('memcached')->forget($key);
                        }

                        Log::info("Cache foi limpado com sucesso no company: {$id}");
                    }
                }
            }

            $apiService = new ApiService();
            $apiData = $apiService->getData(env('API_URL').'/place', env('API_USERNAME'), env('API_PASSWORD'), $id);

            if ($apiData) {
                $apiData = array_slice($apiData, 1, null, true); //exclui o primeiro elemento (key 0)
                foreach ($apiData as $key => $value) {
                    if ($key == 'featured_banners') {
                        Banner::where('company_id', $id)->delete();
                        Log::info("Banners deletados no company: {$id}");
                        foreach ($value as $key1 => $value1) {
                            Banner::create([
                                'id' => $value1['id'],
                                'company_id' => $id, 
                                'image' => isset($value1['image']) ? $value1['image'] : null, 
                                'title' => isset($value1['title']) ? $value1['title'] : null, 
                                'subtitle' => isset($value1['subtitle']) ? $value1['subtitle'] : null,
                                'link' => isset($value1['link']) ? $value1['link'] : null,
                            ]);
                            Log::info("Novo Banner inserido: {$value1['image']} => {$value1['link']} no company: {$id}");
                        }
                    } else if ($key == 'configs') {
                        CompanyConfig::where('company_id', $id)->delete();
                        Log::info("Config deletada no company: {$id}");
                        foreach ($value as $key1 => $value1) {
                            CompanyConfig::create([
                                'company_id' => $id, 
                                'key' => $key1,
                                'value' => $value1,
                            ]);
                            Log::info("Nova config inserida: {$key1} => {$value1} no company: {$id}");
                        }
                    } else if ($key == 'events') {
                        foreach ($value as $key1 => $value1) {
                            $config = Event::where('company_id', $id)->where('id', $value1['id'])->first();
                            if ($config) {
                                $eventData = [
                                    'name' => $value1['name'],
                                    'date' => $value1['date'],
                                    'start_hour' => $value1['start_hour'],
                                    'place_open_hour' => $value1['place_open_hour'],
                                    'description' => $value1['description'],
                                    'description_append' => isset($value1['description_append']) ? $value1['description_append'] : null,
                                    'image' => isset($value1['image']) ? $value1['image'] : null,
                                    'event_map_image' => isset($value1['event_map_image']) ? $value1['event_map_image'] : null,
                                    'fl_show_payment_methods' => isset($value1['fl_show_payment_methods']) ? $value1['fl_show_payment_methods'] : null,
                                    'fl_show_organizer' => isset($value1['fl_show_organizer']) ? $value1['fl_show_organizer'] : null,
                                    'fl_show_classification' => isset($value1['fl_show_classification']) ? $value1['fl_show_classification'] : null,
                                    'fl_featured' => isset($value1['fl_featured']) ? $value1['fl_featured'] : 0,
                                    'classification_text' => isset($value1['classification_text']) ? $value1['classification_text'] : null,
                                    'uri' => isset($value1['uri']) ? $value1['uri'] : null,
                                    'meta_title' => isset($value1['meta_title']) ? $value1['meta_title'] : null,
                                    'meta_description' => isset($value1['meta_description']) ? $value1['meta_description'] : null,
                                ];

                                if (!is_null($value1['category'])) {
                                    $eventData['category_id'] = isset($value1['category']['id']) ? $value1['category']['id'] : null;
                                    $eventData['category_name'] = isset($value1['category']['name']) ? $value1['category']['name'] : null;
                                    $eventData['category_uri'] = isset($value1['category']['uri']) ? $value1['category']['uri'] : null;
                                }
                                if (!is_null($value1['group'])) {
                                    $eventData['group_id'] = isset($value1['group']['id']) ? $value1['group']['id'] : null;
                                    $eventData['group_name'] = isset($value1['group']['name']) ? $value1['group']['name'] : null;
                                    $eventData['group_uri'] = isset($value1['group']['uri']) ? $value1['group']['uri'] : null;
                                }
                                if (!is_null($value1['place'])) {
                                    $eventData['place_id'] = isset($value1['place']['id']) ? $value1['place']['id'] : null;
                                    $eventData['place_name'] = isset($value1['place']['name']) ? $value1['place']['name'] : null;
                                    $eventData['place_address'] = isset($value1['place']['address']) ? $value1['place']['address'] : null;
                                }
                                if (!is_null($value1['organizer'])) {
                                    $eventData['organizer_id'] = isset($value1['organizer']['id']) ? $value1['organizer']['id'] : null;
                                    $eventData['organizer_name'] = isset($value1['organizer']['name']) ? $value1['organizer']['name'] : null;
                                    $eventData['organizer_logo'] = isset($value1['organizer']['logo']) ? $value1['organizer']['logo'] : null;
                                }
                                
                                $config->update($eventData);
                                Log::info("Evento atualizado: id => {$value1['id']} no company: {$id}");
                            } else {
                                $eventData = [
                                    'id' => $value1['id'],
                                    'company_id' => $id, 
                                    'name' => $value1['name'],
                                    'date' => $value1['date'],
                                    'start_hour' => $value1['start_hour'],
                                    'place_open_hour' => $value1['place_open_hour'],
                                    'description' => $value1['description'],
                                    'description_append' => isset($value1['description_append']) ? $value1['description_append'] : null,
                                    'image' => isset($value1['image']) ? $value1['image'] : null,
                                    'event_map_image' => isset($value1['event_map_image']) ? $value1['event_map_image'] : null,
                                    'fl_show_payment_methods' => isset($value1['fl_show_payment_methods']) ? $value1['fl_show_payment_methods'] : null,
                                    'fl_show_organizer' => isset($value1['fl_show_organizer']) ? $value1['fl_show_organizer'] : null,
                                    'fl_show_classification' => isset($value1['fl_show_classification']) ? $value1['fl_show_classification'] : null,
                                    'fl_featured' => isset($value1['fl_featured']) ? $value1['fl_featured'] : 0,
                                    'classification_text' => isset($value1['classification_text']) ? $value1['classification_text'] : null,
                                    'uri' => isset($value1['uri']) ? $value1['uri'] : null,
                                    'meta_title' => isset($value1['meta_title']) ? $value1['meta_title'] : null,
                                    'meta_description' => isset($value1['meta_description']) ? $value1['meta_description'] : null,
                                ];

                                if (!is_null($value1['category'])) {
                                    $eventData['category_id'] = isset($value1['category']['id']) ? $value1['category']['id'] : null;
                                    $eventData['category_name'] = isset($value1['category']['name']) ? $value1['category']['name'] : null;
                                    $eventData['category_uri'] = isset($value1['category']['uri']) ? $value1['category']['uri'] : null;
                                }
                                if (!is_null($value1['group'])) {
                                    $eventData['group_id'] = isset($value1['group']['id']) ? $value1['group']['id'] : null;
                                    $eventData['group_name'] = isset($value1['group']['name']) ? $value1['group']['name'] : null;
                                    $eventData['group_uri'] = isset($value1['group']['uri']) ? $value1['group']['uri'] : null;
                                }
                                if (!is_null($value1['place'])) {
                                    $eventData['place_id'] = isset($value1['place']['id']) ? $value1['place']['id'] : null;
                                    $eventData['place_name'] = isset($value1['place']['name']) ? $value1['place']['name'] : null;
                                    $eventData['place_address'] = isset($value1['place']['address']) ? $value1['place']['address'] : null;
                                }
                                if (!is_null($value1['organizer'])) {
                                    $eventData['organizer_id'] = isset($value1['organizer']['id']) ? $value1['organizer']['id'] : null;
                                    $eventData['organizer_name'] = isset($value1['organizer']['name']) ? $value1['organizer']['name'] : null;
                                    $eventData['organizer_logo'] = isset($value1['organizer']['logo']) ? $value1['organizer']['logo'] : null;
                                }

                                Event::create($eventData);
                                Log::info("Novo evento inserido: id => {$value1['id']} no company: {$id}");
                            }
                        }
                    }
                }
                // Cache os dados da empresa por um período de tempo (por exemplo, 60 minutos)
                // Cache::put('company_' . $host, $apiData, 60); // 60 minutos
                
                return response()->json(['message' => 'Dados da config atualizados com sucesso'], 200);
            }

            Log::error('Nenhuma config da empresa recebida pela API');
            return response()->json(['error' => 'Nenhuma config da empresa recebida pela API'], 400);
        } catch (\Exception $e) {
            Log::error('Erro ao acessar a API: ' . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao acessar a API'], 500);
        }
    }
}
