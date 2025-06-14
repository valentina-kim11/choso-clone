
<div class="space-y-4 px-4 sm:px-6">
    <h1 class="text-xl font-semibold mb-4">{{ __('Checkout') }}</h1>
    <ul class="space-y-2">
        @foreach($items as $item)
            <li class="flex justify-between">
                <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                <span>{{ number_format($item['product']->price * $item['quantity']) }} Scoin</span>
            </li>
        @endforeach
    </ul>
    <div class="space-x-2">
        <input type="text" wire:model="couponCode" placeholder="{{ __('Coupon code') }}" class="border border-brand-gray p-1 rounded text-black" />
        <button type="button" wire:click="applyCoupon" class="bg-info text-white px-2 py-1 rounded">{{ __('Apply') }}</button>
        @error('couponCode') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    @if($discount > 0)
        <div>{{ __('Discount') }}: -{{ number_format($discount) }} Scoin</div>
    @endif
    <div class="font-semibold">{{ __('Total') }}: {{ number_format($payable) }} Scoin</div>
    <button wire:click="pay" class="bg-primary text-white px-4 py-2 rounded">{{ __('Pay with Wallet') }}</button>
    <x-auth-session-status class="text-center" :status="session('status')" />
</div>

