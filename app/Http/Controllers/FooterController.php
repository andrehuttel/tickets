<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Services\ApiService;
use DateTime;

class FooterController extends Controller
{
    public function showTermsOfUse(Request $request) 
    {
        $dataEvents = $request->get('data')['events'];
        $events = $this->getFilteredEvents($dataEvents);

        return Inertia::render('TermsOfUse', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'events' => $events,
            'searchButtonMenu' => true,
        ]);
    }

    public function showPrivacyPolicy(Request $request) 
    {
        $dataEvents = $request->get('data')['events'];
        $events = $this->getFilteredEvents($dataEvents);

        return Inertia::render('PrivacyPolicy', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'events' => $events,
            'searchButtonMenu' => true,
        ]);
    }

    public function showServiceTax(Request $request) 
    {
        $dataEvents = $request->get('data')['events'];
        $events = $this->getFilteredEvents($dataEvents);

        return Inertia::render('ServiceTax', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'events' => $events,
            'searchButtonMenu' => true,
        ]);
    }

    public function showHalfEntry(Request $request) 
    {
        $dataEvents = $request->get('data')['events'];
        $events = $this->getFilteredEvents($dataEvents);

        return Inertia::render('HalfEntry', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'events' => $events,
            'searchButtonMenu' => true,
        ]);
    }

    public function showAboutUs(Request $request) 
    {
        return Inertia::render('AboutUs', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function showContact(Request $request) 
    {
        return Inertia::render('Contact', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function getFilteredEvents($events){
        $filteredEvents = collect($events)
        ->filter(function ($event) {
            $eventDate = new DateTime($event->date);
            $today = new DateTime();
            return $eventDate >= $today;
        })
        ->sortBy('date')
        ->take(3);

        return $filteredEvents;
    }

    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'fone' => 'min:14|max:15',
            'message' => 'required|max:500',
        ]);

        if ($validatedData) {
            $validatedData['type'] = 'contact';
            $validatedData['subject'] = 'Contato via site';
            $validatedData['fone'] = preg_replace('/[^0-9]/', '', $validatedData['fone']);
            $apiService = new ApiService();
            $apiData = $apiService->postData(env('API_URL').'/send-message', env('API_USERNAME'), env('API_PASSWORD'), $validatedData);
            if($apiData){
                return response()->json(['message' => 'E-mail enviado com sucesso!']);
            }
            return response()->json(['error' => 'Não foi possível enviar a mensagem, entre em contato de outra forma.'], 400);
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }
}
