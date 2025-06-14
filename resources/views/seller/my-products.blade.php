<div class="px-4 sm:px-6">
    <h1 class="text-xl font-semibold mb-4">{{ __('My Products') }}</h1>

    <a href="{{ route('seller.products.create') }}" class="bg-info text-dark px-4 py-2 rounded" wire:navigate>{{ __('Add Product') }}</a>



    <ul class="mt-4 space-y-2">
        @foreach($products as $product)
            <li class="border border-brand-gray p-2 flex justify-between">
                <span>{{ $product->name }}</span>
                <div class="space-x-2">
                    <a href="{{ route('seller.products.edit', $product) }}" class="bg-info text-dark px-2 py-1 rounded" wire:navigate>{{ __('Edit') }}</a>
                    <button type="button" wire:click="delete({{ $product->id }})" class="text-danger">{{ __('Delete') }}</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
