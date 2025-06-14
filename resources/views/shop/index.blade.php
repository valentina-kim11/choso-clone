<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-4 sm:px-6">
    @foreach($products as $product)
        <a
            href="{{ route('shop.show', $product) }}"
            wire:navigate
            class="overflow-hidden rounded-lg border border-brand-gray/30 transition hover:ring-2 hover:ring-accent focus:outline-none focus:ring-2 focus:ring-accent"
        >
            <img
                src="{{ $product->cover_url }}"
                alt="{{ $product->name }}"
                class="h-40 w-full object-cover"
            >
            <div class="p-4 space-y-1">
                <h2 class="text-lg font-semibold text-primary">{{ $product->name }}</h2>
                <p class="text-xs text-brand-gray/60">{{ $product->category?->name }}</p>
                <p class="font-semibold text-primary">{{ number_format($product->price) }} Scoin</p>
            </div>
        </a>
    @endforeach
</div>
