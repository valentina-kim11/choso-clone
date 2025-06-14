<div>
    <h1 class="text-xl font-semibold mb-4">Manage Categories</h1>

    @if(session('status'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mb-4 space-x-2">
        <input type="text" wire:model="name" placeholder="Name" class="border p-1 rounded" />
        <button type="submit" class="bg-blue-500 px-3 py-1 rounded text-white">
            {{ $editingId ? 'Update' : 'Add' }}
        </button>
        @if($editingId)
            <button type="button" wire:click="$set('editingId', null)">Cancel</button>
        @endif
    </form>

    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">Name</th>
                <th class="p-2">Slug</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td class="p-2">{{ $category->name }}</td>
                    <td class="p-2">{{ $category->slug }}</td>
                    <td class="p-2 space-x-2">
                        <button wire:click="edit({{ $category->id }})" class="text-blue-500">Edit</button>
                        <button wire:click="delete({{ $category->id }})" class="text-red-600">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
