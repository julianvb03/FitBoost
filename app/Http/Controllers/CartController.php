<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

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

        return view('cart.index')->with($viewData);
    }

    public function store(AddToCartRequest $request): RedirectResponse
    {
        try {
            $result = $this->cartService->addItem($request->getSupplementId(), $request->getQuantity());

            $flashKey = $result['capped'] ? 'warning' : 'success';
            $flashMsg = $result['capped'] ? Lang::get('cart.stock_capped') : Lang::get('cart.added');
            return back()->with($flashKey, $flashMsg);
        } catch (\Throwable $e) {
            return back()->with('error', Lang::get('cart.error'));
        }
    }

    public function update(UpdateCartItemRequest $request, int $supplement): RedirectResponse
    {
        try {
            $result = $this->cartService->updateQuantity($supplement, $request->getQuantity());
            $flashKey = $result['capped'] ? 'warning' : 'success';
            $flashMsg = $result['capped'] ? Lang::get('cart.stock_capped') : Lang::get('cart.updated');
            return back()->with($flashKey, $flashMsg);
        } catch (\Throwable $e) {
            return back()->with('error', Lang::get('cart.error'));
        }
    }

    public function destroy(int $supplement): RedirectResponse
    {
        try {
            $this->cartService->removeItem($supplement);

            return back()->with('success', Lang::get('cart.removed'));
        } catch (\Throwable $e) {
            return back()->with('error', Lang::get('cart.error'));
        }
    }

    public function clear(): RedirectResponse
    {
        try {
            $this->cartService->clear();

            return back()->with('success', Lang::get('cart.cleared'));
        } catch (\Throwable $e) {
            return back()->with('error', Lang::get('cart.error'));
        }
    }

    public function checkout(CheckoutRequest $request): RedirectResponse
    {
        try {
            $this->cartService->checkout();

            return redirect()->route('cart.index')->with('success', Lang::get('cart.checkout_pending'));
        } catch (\Throwable $e) {
            return back()->with('error', Lang::get('cart.error'));
        }
    }
}
