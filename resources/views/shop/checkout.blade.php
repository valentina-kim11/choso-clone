<div class="space-y-4">
    <h1 class="text-xl font-semibold mb-4">Checkout</h1>
    <ul class="space-y-2">
        @foreach($items as $item)
            <li class="flex justify-between">
                <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                <span>{{ number_format($item['product']->price * $item['quantity']) }} Scoin</span>
            </li>
        @endforeach
    </ul>
    <div class="font-semibold">Total: {{ number_format($total) }} Scoin</div>
    <button wire:click="pay" class="bg-[#00796B] text-white px-4 py-2 rounded">Pay with Wallet</button>
    <x-auth-session-status class="text-center" :status="session('status')" />
</div>
