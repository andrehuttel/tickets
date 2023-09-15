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
        $searchTerm = $request->query('q');

        $event = Event::where('name', 'like', '%' . $searchTerm . '%')
        ->where('company_id', $request->get('data')['company']['id'])
        ->orderBy('date', 'asc')
        ->get();

        return Inertia::render('SearchResults', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'event' => $event, // Passa o evento para a vista
            'searchButtonMenu' => false,
            'filter' => Request()->query('q'),
        ]);
    }
}
