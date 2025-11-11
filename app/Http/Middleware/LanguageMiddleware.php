<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        $sessionLang = Session::get('lang');
        $cookieLang = $request->cookie('lang');
        
        $locale = $sessionLang ?? $cookieLang ?? 'es';
        
        if ($locale && $locale !== $sessionLang) {
            Session::put('lang', $locale);
        }
        
        App::setLocale($locale);

        return $next($request);
    }
}
