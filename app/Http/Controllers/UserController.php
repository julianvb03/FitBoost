<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct() {}

    public function show(): View
    {
        $user = User::find(Auth::user()->getId());
        $userOrders = $user->getOrders();

        $viewData = [];
        $viewData['user'] = $user;
        $viewData['orders'] = $userOrders;

        return view('users.show')->with('viewData', $viewData);
    }

    public function edit(): View
    {
        $user = User::find(Auth::user()->getId());

        $viewData = [];
        $viewData['user'] = $user;

        return view('users.edit')->with('viewData', $viewData);
    }

    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $user = User::find(Auth::user()->getId());
        $viewData = [];

        if ($request->input('password')) {
            if ($request->input('password') === $request->input('confitm_password')) {
                $user->setPassword($request->input('password'));
            } else {
                $viewData['error'] = trans('user/profile.passwords_do_not_match');
                redirect()->back()->with('viewData', $viewData);
            }
        }

        if ($request->input('name')) {
            $user->setName($request->input('name'));
        }

        if ($request->input('email')) {
            $user->setEmail($request->input('email'));
        }

        if ($request->input('card_data')) {
            $user->setCardData($request->input('card_data'));
        }

        if ($request->input('address')) {
            $user->setAddress($request->input('address'));
        }

        $user->save();
        $viewData['success'] = trans('user/profile.profile_updated_succesfuly');

        return redirect()->back()->with('viewData', $viewData);
    }
}
