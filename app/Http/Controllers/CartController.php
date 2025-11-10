<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

final class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): View
    {
        $cart = $this->cartService->getCart();

        $viewData = [];
        $viewData['items'] = $cart['items'] ?? [];
        $viewData['total'] = $cart['total'] ?? 0;
        $viewData['count'] = $cart['count'] ?? 0;

        if (session('viewData')) {
            $sessionViewData = session('viewData');
            if (isset($sessionViewData['success'])) {
                $viewData['success'] = $sessionViewData['success'];
            }
            if (isset($sessionViewData['error'])) {
                $viewData['error'] = $sessionViewData['error'];
            }
            if (isset($sessionViewData['warning'])) {
                $viewData['warning'] = $sessionViewData['warning'];
            }
        }

        return view('cart.index')->with('viewData', $viewData);
    }

    public function store(AddToCartRequest $request): RedirectResponse
    {
        $viewData = [];

        try {
            $result = $this->cartService->addItem($request->getSupplementId(), $request->getQuantity());

            if ($result['capped']) {
                $viewData['warning'] = trans('cart.stock_capped');
            } else {
                $viewData['success'] = trans('cart.added');
            }

            return back()->with('viewData', $viewData);
        } catch (Throwable $e) {
            $viewData['error'] = trans('cart.error');

            return back()->with('viewData', $viewData);
        }
    }

    public function update(UpdateCartItemRequest $request, int $supplement): RedirectResponse
    {
        $viewData = [];

        try {
            $result = $this->cartService->updateQuantity($supplement, $request->getQuantity());

            if ($result['capped']) {
                $viewData['warning'] = trans('cart.stock_capped');
            } else {
                $viewData['success'] = trans('cart.updated');
            }

            return back()->with('viewData', $viewData);
        } catch (Throwable $e) {
            $viewData['error'] = trans('cart.error');

            return back()->with('viewData', $viewData);
        }
    }

    public function destroy(int $supplement): RedirectResponse
    {
        $viewData = [];

        try {
            $this->cartService->removeItem($supplement);
            $viewData['success'] = trans('cart.removed');

            return back()->with('viewData', $viewData);
        } catch (Throwable $e) {
            $viewData['error'] = trans('cart.error');

            return back()->with('viewData', $viewData);
        }
    }

    public function clear(): RedirectResponse
    {
        $viewData = [];

        try {
            $this->cartService->clear();
            $viewData['success'] = trans('cart.cleared');

            return back()->with('viewData', $viewData);
        } catch (Throwable $e) {
            $viewData['error'] = trans('cart.error');

            return back()->with('viewData', $viewData);
        }
    }

    public function checkout(CheckoutRequest $request): RedirectResponse
    {
        $viewData = [];

        try {
            $this->cartService->checkout();
            $viewData['success'] = trans('cart.checkout_pending');

            return redirect()->route('cart.index')->with('viewData', $viewData);
        } catch (Throwable $e) {
            $viewData['success'] = trans('cart.checkout_pending');

            return redirect()->route('cart.index')->with('viewData', $viewData);
        }
    }
}
