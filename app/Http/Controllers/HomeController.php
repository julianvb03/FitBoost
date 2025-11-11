<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $sessionLang = Session::get('lang');
        $cookieLang = request()->cookie('lang');
        
        $locale = $sessionLang ?? $cookieLang ?? 'es';
        App::setLocale($locale);
        
        return view('home');
    }
}
