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
        } else if(!is_null($category) && is_null($uri)){
            $company_id = $request->get('data')['company']['id'];
            $category = Event::where('company_id', $company_id)->where('category_name', $category)->orderBy('category_name', 'asc')
                ->select('category_id', 'category_name')->distinct()->get();
            if(!empty($category) && isset($category[0]['category_id'])) {
                $events = Event::where('category_id', $category[0]['category_id'])
                    ->where('company_id', $request->get('data')['company']['id'])
                    ->orderBy('date', 'asc')
                    ->get();
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
            $company_id = $request->get('data')['company']['id'];
            $group = Event::where('company_id', $company_id)->where('group_uri', $group)->select('group_id', 'group_name')->distinct()->get();
            if(!empty($group) && isset($group[0]['group_id'])) {
                $events = Event::where('group_id', $group[0]['group_id'])
                    ->where('company_id', $request->get('data')['company']['id'])
                    ->get();
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
