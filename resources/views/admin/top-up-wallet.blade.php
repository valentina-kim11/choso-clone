<div>
    <h1 class="text-xl font-semibold mb-4">Top Up Wallet</h1>

    @if(session('status'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('status') }}</div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model="search" placeholder="Search" class="border p-1 rounded" />
    </div>

    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">
                        <input type="number" wire:model.defer="amounts.{{ $user->id }}" class="border p-1 rounded w-24" />
                    </td>
                    <td class="p-2">
                        <button wire:click="topUp({{ $user->id }})" class="text-blue-600">Top Up</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
