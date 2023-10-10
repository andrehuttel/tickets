<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function findEvent(Request $request)
    {
        $dataEvents = $request->get('data')['all_events'];

        $searchTerm = $request->query('q');
        $filteredEvents = $dataEvents->filter(function ($event) use ($searchTerm) {
            return stristr($event->name, $searchTerm);
        });

        $events = $filteredEvents->sortBy('date');

        if (!$events) {
            $events = null;
        }

        return Inertia::render('SearchResults', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'events' => $events,
            'searchButtonMenu' => false,
            'filter' => $searchTerm,
        ]);
    }
}
