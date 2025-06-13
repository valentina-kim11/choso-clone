<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($products as $product)
        <a href="{{ route('shop.show', $product) }}" class="border border-[#374151] rounded p-4" wire:navigate>
            <h2 class="font-semibold text-lg">{{ $product->name }}</h2>
            <p class="text-[#4FC3F7]">{{ number_format($product->price) }} Scoin</p>
        </a>
    @endforeach
</div>
