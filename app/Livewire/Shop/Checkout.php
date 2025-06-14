<?php

namespace App\Livewire\Shop;

use App\Services\CartService;
use App\Services\CheckoutService;
use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

#[Layout('components.layouts.market')]
class Checkout extends Component
{
    public array $items = [];
    public string $couponCode = '';
    protected ?Coupon $coupon = null;

    public function mount(): void
    {
        $this->items = app(CartService::class)->loadFromSession();
    }

    public function pay(): RedirectResponse|null
    {
        $user = Auth::user();

        if (! $user) {
            return null;
        }

        $service = app(CheckoutService::class);
        $order = $service->pay($user, $this->items, $this->coupon);

        if (! $order) {
            session()->flash('status', __('Insufficient wallet balance'));
            return null;
        }

        $this->clear();
        $this->coupon = null;
        $this->couponCode = '';
        $this->dispatch('cart-cleared');
        session()->flash('order_id', $order->id);

        return redirect()->route('shop.thank-you');
    }

    protected function total(): float
    {
        return collect($this->items)
            ->sum(fn ($item) => $item['product']->price * $item['quantity']);
    }

    protected function clear(): void
    {
        $this->items = [];
        app(CartService::class)->clearSession();
    }

    public function applyCoupon(): void
    {
        $this->resetErrorBag('couponCode');
        $coupon = Coupon::where('code', $this->couponCode)->first();
        if (! $coupon) {
            $this->addError('couponCode', __('Invalid coupon'));
            return;
        }
        if ($coupon->isExpired()) {
            $this->addError('couponCode', __('Coupon expired'));
            return;
        }
        if ($coupon->isMaxed()) {
            $this->addError('couponCode', __('Coupon limit reached'));
            return;
        }

        $this->coupon = $coupon;
    }

    protected function discount(): float
    {
        if (! $this->coupon) {
            return 0.0;
        }

        $total = $this->total();
        $amount = $this->coupon->type === 'percent'
            ? $total * $this->coupon->value / 100
            : $this->coupon->value;

        return min($amount, $total);
    }

    protected function payable(): float
    {
        return $this->total() - $this->discount();
    }

    public function render()
    {
        return view('shop.checkout', [
            'total' => $this->total(),
            'discount' => $this->discount(),
            'payable' => $this->payable(),
        ]);
    }
}
