<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function show(Request $request, $name)
    {
        $company_id = $request->get('data')['company']['id'];
        $category = Event::where('company_id', $company_id)->where('category_name', $name)
            ->select('category_id')->distinct()->get();
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
            'categoryName' => $name,
            'searchButtonMenu' => true,
        ]);
    }
}
