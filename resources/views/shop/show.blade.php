<div class="max-w-2xl mx-auto space-y-4">
    <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p class="text-accent font-semibold">{{ number_format($product->price) }} Scoin</p>
    <button wire:click="dispatch('add-to-cart', id: $product->id)" class="bg-primary text-white px-4 py-2 rounded">{{ __('Add to Cart') }}</button>
</div>
