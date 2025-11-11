<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageSwitchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(LanguageSwitchRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $lang = $validatedData['lang'];

        Session::put('lang', $lang);
        App::setLocale($lang);

        return redirect()->back();
    }
}
