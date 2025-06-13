
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


<x-layouts.market>
    <div class="space-y-4">
        <h1 class="text-xl font-semibold">{{ session('status') }}</h1>
        @if (!empty($downloads))
            <section class="mt-4 border border-[#374151] p-4 rounded">
                <h2 class="font-semibold mb-2">Your Downloads</h2>
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($downloads as $url)
                        <li><a href="{{ $url }}" class="text-[#4FC3F7] underline">{{ basename(parse_url($url, PHP_URL_PATH)) }}</a></li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
</x-layouts.market>


