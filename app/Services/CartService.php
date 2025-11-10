<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Item;
use App\Models\Order;
use App\Models\Supplement;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RuntimeException;

final class CartService
{
    private const STATUS_CART = 'cart';

    private Guard $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function getCart(): array
    {
        if ($this->auth->check()) {
            $order = $this->getOrCreateUserCart();
            $items = $order->items()->with('supplement')->get();
            $total = $order->calculateTotalAmount();
            $count = $items->sum(fn ($i) => $i->getQuantity());

            return [
                'items' => $items,
                'total' => $total,
                'count' => $count,
            ];
        }

        $sessionItems = (array) Session::get('cart.items', []);
        $supplements = Supplement::whereIn('id', array_keys($sessionItems))->get()->keyBy('id');

        $items = [];
        $total = 0;
        $count = 0;
        foreach ($sessionItems as $supplementId => $data) {
            $supplement = $supplements->get($supplementId);
            if (! $supplement) {
                continue;
            }
            $quantity = (int) ($data['quantity'] ?? 1);
            $subtotal = $supplement->getPrice() * $quantity;
            $total += $subtotal;
            $count += $quantity;
            $items[] = [
                'supplement' => $supplement,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return [
            'items' => $items,
            'total' => $total,
            'count' => $count,
        ];
    }

    public function addItem(int $supplementId, int $quantity): array
    {
        $quantity = max(1, min(99, $quantity));
        $supplement = Supplement::findOrFail($supplementId);

        if ($this->auth->check()) {
            $order = $this->getOrCreateUserCart();
            $item = $order->items()->where('supplement_id', $supplementId)->first();
            if ($item === null) {
                $item = new Item;
                $item->setOrderId($order->getId());
                $item->setQuantity(0);
                $item->setTotalPrice(0);
                $item->setAttribute('supplement_id', $supplementId);
                $item->save();
            }

            $requested = $item->getQuantity() + $quantity;
            $newQuantity = min($supplement->getStock(), $requested);
            $item->setQuantity($newQuantity);
            $item->setTotalPrice($supplement->getPrice() * $newQuantity);
            $item->save();

            return ['capped' => $newQuantity < $requested];
        }

        $items = (array) Session::get('cart.items', []);
        $current = (int) ($items[$supplementId]['quantity'] ?? 0);
        $requested = $current + $quantity;
        $newQuantity = min($supplement->getStock(), $requested);
        $items[$supplementId] = ['quantity' => $newQuantity];
        Session::put('cart.items', $items);

        return ['capped' => $newQuantity < $requested];
    }

    public function updateQuantity(int $supplementId, int $quantity): array
    {
        $quantity = max(1, min(99, $quantity));
        $supplement = Supplement::findOrFail($supplementId);

        if ($this->auth->check()) {
            $order = $this->getOrCreateUserCart();
            $item = $order->items()->where('supplement_id', $supplementId)->first();
            if ($item === null) {
                return ['capped' => false];
            }
            $final = min($supplement->getStock(), $quantity);
            $item->setQuantity($final);
            $item->setTotalPrice($supplement->getPrice() * $final);
            $item->save();

            return ['capped' => $final < $quantity];
        }

        $items = (array) Session::get('cart.items', []);
        if (! array_key_exists($supplementId, $items)) {
            return ['capped' => false];
        }
        $final = min($supplement->getStock(), $quantity);
        $items[$supplementId]['quantity'] = $final;
        Session::put('cart.items', $items);

        return ['capped' => $final < $quantity];
    }

    public function removeItem(int $supplementId): void
    {
        if ($this->auth->check()) {
            $order = $this->getOrCreateUserCart();
            $order->items()->where('supplement_id', $supplementId)->delete();

            return;
        }

        $items = (array) Session::get('cart.items', []);
        unset($items[$supplementId]);
        Session::put('cart.items', $items);
    }

    public function clear(): void
    {
        if ($this->auth->check()) {
            $order = $this->getOrCreateUserCart();
            $order->items()->delete();

            return;
        }

        Session::forget('cart.items');
    }

    public function checkout(): void
    {
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $order = $this->getOrCreateUserCart();
        $items = $order->items()->with('supplement')->get();

        foreach ($items as $item) {
            $supplement = $item->getSupplement();
            $quantity = min($supplement->getStock(), $item->getQuantity());
            $item->setQuantity($quantity);
            $item->setTotalPrice($supplement->getPrice() * $quantity);
            $item->save();
        }

        $totalAmount = $order->calculateTotalAmount();
        $order->setTotalAmount($totalAmount);
        $order->setStatus('pending');
        $order->save();

        $this->createEmptyCartIfMissing();

        Session::forget('cart.items');
    }

    public function mergeSessionToUserCart(): void
    {
        if (! $this->auth->check()) {
            return;
        }
        $items = (array) Session::get('cart.items', []);
        if (empty($items)) {
            return;
        }

        foreach ($items as $supplementId => $data) {
            $this->addItem((int) $supplementId, (int) ($data['quantity'] ?? 1));
        }

        Session::forget('cart.items');
    }

    private function getOrCreateUserCart(): Order
    {
        $user = $this->auth->user();
        $order = Order::where('user_id', $user->getId())
            ->where('status', self::STATUS_CART)
            ->first();

        if ($order) {
            return $order;
        }

        $order = new Order;
        $order->setUserId($user->getId());
        $order->setStatus(self::STATUS_CART);
        $order->setTotalAmount(0);
        $order->save();

        return $order;
    }

    private function createEmptyCartIfMissing(): void
    {
        $user = $this->auth->user();
        $exists = Order::where('user_id', $user->getId())
            ->where('status', self::STATUS_CART)
            ->exists();

        if (! $exists) {
            $order = new Order;
            $order->setUserId($user->getId());
            $order->setStatus(self::STATUS_CART);
            $order->setTotalAmount(0);
            $order->save();
        }
    }
}
