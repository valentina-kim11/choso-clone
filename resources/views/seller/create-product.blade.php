<form wire:submit.prevent="save" class="space-y-4">
    <h1 class="text-xl font-semibold">Add Product</h1>
    <div>
        <label class="block">Name</label>
        <input type="text" wire:model="name" class="w-full bg-[#374151] border border-[#374151] p-2" />
    </div>
    <div>
        <label class="block">Price (Scoin)</label>
        <input type="number" wire:model="price" step="0.01" class="w-full bg-[#374151] border border-[#374151] p-2" />
    </div>
    <div>
        <label class="block">Category</label>
        <select wire:model="category_id" class="w-full bg-[#374151] border border-[#374151] p-2">
            <option value="">-- Select --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block">Description</label>
        <textarea wire:model="description" class="w-full bg-[#374151] border border-[#374151] p-2"></textarea>
    </div>
    <div>
        <label class="block">File</label>
        <input type="file" wire:model="file" accept=".pdf,.zip" class="w-full" />
    </div>
    <button type="submit" class="bg-[#00796B] px-4 py-2 rounded">Save</button>
</form>
