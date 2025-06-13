<div>
    <h1 class="text-2xl font-semibold mb-4">My Products</h1>

    <a href="{{ route('seller.products.create') }}" class="bg-[#4FC3F7] text-black px-4 py-2 rounded" wire:navigate>Add Product</a>


    <a href="{{ route('seller.products.create') }}" class="bg-[#4FC3F7] text-black px-4 py-2 rounded" wire:navigate>Add Product</a>

    <a href="#" class="bg-[#4FC3F7] text-black px-4 py-2 rounded">Add Product</a>


    <ul class="mt-4 space-y-2">
        @foreach($products as $product)
            <li class="border border-[#374151] p-2">{{ $product->name }}</li>
        @endforeach
    </ul>
</div>
