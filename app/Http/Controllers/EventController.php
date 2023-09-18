<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class EventController extends Controller
{
    public function show(Request $request, $id)
    {
        $event = Event::where('id', $id)
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
        ]);
    }
}
