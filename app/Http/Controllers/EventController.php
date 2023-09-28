<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class EventController extends Controller
{
    public function show(Request $request, $category, $uri = null)
    {
        if(!is_null($uri)) {
            $event = Event::where('uri', $uri)
                ->where('company_id', $request->get('data')['company']['id'])
                ->first();

            if (!$event) {
                abort(404);
            }

            return Inertia::render('Event', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
                'data' => $request->get('data'),
                'event' => $event,
                'searchButtonMenu' => true,
            ]);
        } else {
            $company_id = $request->get('data')['company']['id'];
            $category = Event::where('company_id', $company_id)->where('category_name', $category)
                ->select('category_id', 'category_name')->distinct()->get();
            $category_id = $category[0]['category_id'];
            $events = Event::where('category_id', $category_id)
                ->where('company_id', $request->get('data')['company']['id'])
                ->get();
            if (!$category) {
                abort(404);
            }
            return Inertia::render('Category', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
                'data' => $request->get('data'),
                'events' => $events,
                'categoryName' => $category[0]['category_name'],
                'searchButtonMenu' => true,
            ]);
        }
    }

    public function showGroup(Request $request, $group) 
    {
        $event = Event::where('group_name', $group)
            ->where('company_id', $request->get('data')['company']['id'])
            ->get();

        dd($event);

        if (!$event) {
            abort(404);
        }

        return Inertia::render('Event', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'event' => $event,
            'searchButtonMenu' => true,
        ]);
    }
}
