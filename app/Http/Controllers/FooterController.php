<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function showContact(Request $request) 
    {
        return Inertia::render('Contact', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
        ]);
    }

    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to('andreluizhuttel@gmail.com')->send(new ContactFormMail($validatedData));

        return response()->json(['message' => 'E-mail enviado com sucesso!']);
    }

    public function showEmail(Request $request)
    {
        $email = [
            'subject' => 'Assunto do E-mail',
            'sender' => 'andreluizhuttel@gmail.com',
            'recipient' => 'andreluizhuttel@gmail.com',
            'body' => '<p>Este é o corpo do e-mail.</p>',
        ];

        return Inertia::render('ContactEmail', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'data' => $request->get('data'),
            'searchButtonMenu' => true,
            'email' => $email
        ]);
    }
}
