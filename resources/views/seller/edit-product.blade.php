<form wire:submit.prevent="save" class="space-y-4">
    <h1 class="text-xl font-semibold">{{ __('Edit Product') }}</h1>
    <div>
        <label class="block">{{ __('Name') }}</label>
        <input type="text" wire:model="product.name" class="w-full bg-brand-gray border border-brand-gray p-2" />
    </div>
    <div>
        <label class="block">{{ __('Price (Scoin)') }}</label>
        <input type="number" wire:model="product.price" step="0.01" class="w-full bg-brand-gray border border-brand-gray p-2" />
    </div>
    <div>
        <label class="block">{{ __('Category') }}</label>
        <select wire:model="product.category_id" class="w-full bg-brand-gray border border-brand-gray p-2">
            <option value="">{{ __('-- Select --') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block">{{ __('Description') }}</label>
        <textarea wire:model="product.description" class="w-full bg-brand-gray border border-brand-gray p-2"></textarea>
    </div>
    <div>
        <label class="block">{{ __('File') }}</label>
        <input type="file" wire:model="file" accept=".pdf,.zip" class="w-full" />
    </div>
    <button type="submit" class="bg-primary px-4 py-2 rounded">{{ __('Update') }}</button>
</form>
