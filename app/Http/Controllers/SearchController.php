<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function findEvent(Request $request)
    {
        $searchTerm = $request->query('q');
        $companyId = $request->get('data')['company']['id'];

        $currentPage = intval($request->query('page', 1));
        $cacheKey = 'company_'.$companyId.'_event_search_'.$searchTerm.'page_'.$currentPage;

        $events = Cache::rememberForever($cacheKey, function () use ($searchTerm, $companyId, $currentPage) {
            return Event::query()
                ->when($searchTerm, function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->where('company_id', $companyId)
                ->orderBy('date', 'asc')
                ->paginate(8, ['*'], 'page', $currentPage)
                ->withQueryString();
        });

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
