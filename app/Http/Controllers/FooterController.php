<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class FooterController extends Controller
{
    public function showTermsOfUse(Request $request) 
    {
        return Inertia::render('TermsOfUse', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function showPrivacyPolicy(Request $request) 
    {
        return Inertia::render('PrivacyPolicy', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function showServiceTax(Request $request) 
    {
        return Inertia::render('ServiceTax', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function showHalfEntry(Request $request) 
    {
        return Inertia::render('HalfEntry', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function showAboutUs(Request $request) 
    {
        return Inertia::render('AboutUs', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }
}
