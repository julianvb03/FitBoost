<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use App\Models\Test;
use App\Models\Supplement;



class TestingController extends Controller
{
    public function uno(Request $request): void
    {
        // $category = Category::find(1);
        // $item = Item::find(1);
        // $order = Order::find(1);
        // $user = User::find(1);
        // $review = Review::find(1);
        // $test = Test::find(1);
        // $supplement = Supplement::find(1);

        $user = User::find(2);
        $orders = $user->getOrders();
        $firstOrder = $orders->first();
        dd($firstOrder->getTotalAmount());

        
    }
}