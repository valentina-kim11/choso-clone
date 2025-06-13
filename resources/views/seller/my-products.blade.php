<div>
    <h1 class="text-xl font-semibold mb-4">My Products</h1>
    <a href="{{ route('seller.products.create') }}" class="bg-[#4FC3F7] text-black px-4 py-2 rounded" wire:navigate>Add Product</a>
    <ul class="mt-4 space-y-2">
        @foreach($products as $product)
            <li class="border border-[#374151] p-2 flex justify-between">
                <span>{{ $product->name }}</span>
                <div class="space-x-2">
                    <a href="#" class="text-[#4FC3F7]">Edit</a>
                    <a href="#" class="text-[#EF5350]">Delete</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
