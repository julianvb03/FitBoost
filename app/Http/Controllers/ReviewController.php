<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterSupplementRequest;
use App\Models\Supplement;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{

    public function __construct()
    {
        // Is a best practice to use middleware for authentication and authorization here or on routes?
        // $this->middleware('auth');
    }

    public function store(Request $request): View
    {
    }

    public function show(int $id, int $page): View|RedirectResponse
    {
    }
}