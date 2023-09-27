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

        return Inertia::render('SearchResults', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'events' => Event::query()
                ->when($searchTerm, function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->where('company_id', $request->get('data')['company']['id'])
                ->orderBy('date', 'asc')
                ->paginate(8)
                ->withQueryString(),
            'searchButtonMenu' => false,
            'filter' => $searchTerm,
        ]);
    }
}
