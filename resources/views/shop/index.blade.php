<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($products as $product)
        <a href="{{ route('shop.show', $product) }}" class="border border-brand-gray rounded p-4" wire:navigate>
            <h2 class="font-semibold text-lg">{{ $product->name }}</h2>
            <p class="text-xs text-brand-gray/60 mb-1">{{ $product->category?->name }}</p>
            <p class="text-info">{{ number_format($product->price) }} Scoin</p>
        </a>
    @endforeach
</div>
