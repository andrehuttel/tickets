<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTime;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    public function show(Request $request, $category, $uri = null)
    {
        if(!is_null($uri)) {
            $dataEvents = $request->get('data')['all_events'];
            $event = collect($dataEvents)
            ->filter(function ($event) use ($uri) {
                return $event->uri == $uri;
            })->first();

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
        } else if(!is_null($category) && is_null($uri)){
            $dataCategories = $request->get('data')['categories'];

            $category = $dataCategories->filter(function ($cat) use ($category) {
                return $cat->category_uri === $category;
            })->map(function ($cat) {
                return [
                    'category_id' => $cat->category_id,
                    'category_uri' => $cat->category_uri,
                    'category_name' => $cat->category_name,
                ];
            })->values();

            if(!empty($category) && isset($category[0]['category_id'])) {
                $dataEvents = $request->get('data')['all_events'];
                $events = $dataEvents->filter(function ($event) use ($category) {
                    return $event->category_id === $category[0]['category_id'];
                })->sortBy('date');
            } else{
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
        if(!is_null($group)) {
            $dataEvents = $request->get('data')['all_events'];
            $group = $dataEvents->filter(function ($event) use ($group) {
                $eventDate = new DateTime($event->date);
                $today = new DateTime();
                return $event->group_uri === $group && $eventDate >= $today;
            })->unique('group_id')->map(function ($event) {
                return [
                    'group_id' => $event->group_id,
                    'group_name' => $event->group_name,
                ];
            })->values();
            
            if(!empty($group) && isset($group[0]['group_id'])) {
                $events = $dataEvents->filter(function ($event) use ($group) {
                    $eventDate = new DateTime($event->date);
                    $today = new DateTime();
                    return $event->group_id === $group[0]['group_id'] && $eventDate >= $today;
                })->values();
            } else{
                abort(404);
            }

            return Inertia::render('Group', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
                'data' => $request->get('data'),
                'events' => $events,
                'groupName' => $group[0]['group_name'],
                'searchButtonMenu' => true,
            ]);
        } else {
            abort(404);
        }
    }
}
