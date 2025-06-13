<div class="max-w-2xl mx-auto space-y-4">
    <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p class="text-[#FFD54F] font-semibold">{{ number_format($product->price) }} Scoin</p>
    <button wire:click="dispatch('add-to-cart', id: $product->id)" class="bg-[#00796B] text-white px-4 py-2 rounded">Add to Cart</button>
</div>
