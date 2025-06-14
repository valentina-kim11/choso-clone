<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    /**
     * Load cart items from the session.
     *
     * @return array{id: array{product: Product, quantity: int}}
     */
    public function loadFromSession(): array
    {
        $items = [];
        $stored = session('cart.items', []);
        foreach ($stored as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $items[$id] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return $items;
    }

    /**
     * Store the provided cart items to the session.
     */
    public function storeToSession(array $items): void
    {
        $sessionItems = [];
        foreach ($items as $id => $item) {
            $sessionItems[$id] = $item['quantity'];
        }

        session(['cart.items' => $sessionItems]);
    }

    /**
     * Clear the cart from the session.
     */
    public function clearSession(): void
    {
        session()->forget('cart.items');
    }
}
