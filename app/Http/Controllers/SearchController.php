<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Obtenha o critério de pesquisa da URL
        $searchTerm = $request->query('q');

    // Realize a pesquisa de eventos com base no critério
        $event = Event::where('name', 'like', '%' . $searchTerm . '%')
        ->where('company_id', $request->get('data')['company']['id'])
        ->get();

        //dd($event);
        //$event = Event::where('id', $id)->where('company_id', $request->get('data')['company']['id'])->first(); // Recupera o evento com base no ID
        // if (!$event) {
        //     abort(404);
        // }
        return Inertia::render('SearchResults', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'event' => $event, // Passa o evento para a vista
            'searchButtonMenu' => false,
        ]);
    }
}
