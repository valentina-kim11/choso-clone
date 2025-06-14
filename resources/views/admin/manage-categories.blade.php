<div>
    <h1 class="text-xl font-semibold mb-4">{{ __('Manage Categories') }}</h1>

    @if(session('status'))
        <div class="mb-4 text-info">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mb-4 space-x-2">
        <input type="text" wire:model="name" placeholder="{{ __('Name') }}" class="border border-brand-gray p-1 rounded" />
        <button type="submit" class="bg-primary px-3 py-1 rounded text-white">
            {{ $editingId ? __('Update') : __('Add') }}
        </button>
        @if($editingId)
            <button type="button" wire:click="$set('editingId', null)">{{ __('Cancel') }}</button>
        @endif
    </form>

    <div class="border border-brand-gray rounded bg-secondary overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('Name') }}</th>
                <th class="p-2">{{ __('Slug') }}</th>
                <th class="p-2">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td class="p-2">{{ $category->name }}</td>
                    <td class="p-2">{{ $category->slug }}</td>
                    <td class="p-2 space-x-2">
                        <button wire:click="edit({{ $category->id }})" class="bg-info text-dark px-2 py-1 rounded">{{ __('Edit') }}</button>
                        <button wire:click="delete({{ $category->id }})" class="text-danger">{{ __('Delete') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
