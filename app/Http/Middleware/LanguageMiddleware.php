<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = Session::get('lang', 'es');
        App::setLocale($locale);

        return $next($request);
    }
}
