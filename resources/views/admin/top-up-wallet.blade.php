<div>
    <h1 class="text-xl font-semibold mb-4 text-primary">{{ __('Top Up Wallet') }}</h1>

    @if(session('status'))
        <div class="mb-4 text-info">{{ session('status') }}</div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model="search" placeholder="{{ __('Search') }}" class="border border-brand-gray p-1 rounded" />
    </div>

    <div class="bg-dark rounded-2xl shadow p-4 overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('Name') }}</th>
                <th class="p-2">{{ __('Email') }}</th>
                <th class="p-2">{{ __('Amount') }}</th>
                <th class="p-2">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">
                        <input type="number" wire:model.defer="amounts.{{ $user->id }}" class="border border-brand-gray p-1 rounded w-24" />
                    </td>
                    <td class="p-2">
                        <button wire:click="topUp({{ $user->id }})" class="bg-info text-dark px-2 py-1 rounded">{{ __('Top Up') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
