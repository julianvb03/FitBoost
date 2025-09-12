<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LanguageSwitchRequest;

class LanguageController extends Controller
{
    public function change(LanguageSwitchRequest $request): RedirectResponse
    {   
        $validatedData = $request->validated();
        $lang = $validatedData['lang'];
        
        Session::put('lang', $lang);

        return redirect()->back();
    }
}