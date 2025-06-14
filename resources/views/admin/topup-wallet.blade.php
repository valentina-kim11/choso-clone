<div>
    <h1 class="text-xl font-semibold mb-4">Nạp ví cho user</h1>

    @if(session('status'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('status') }}</div>
    @endif

    <input type="text" wire:model.debounce.500ms="search" placeholder="Search..." class="border p-2 rounded mb-4 w-full" />

    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">Tên</th>
                <th class="p-2">Email</th>
                <th class="p-2">Số dư</th>
                <th class="p-2">Nạp tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ number_format($user->wallet) }}</td>
                    <td class="p-2">
                        <input type="number" wire:model.defer="amounts.{{ $user->id }}" class="border p-1 w-24" />
                        <button wire:click="topUp({{ $user->id }})" class="ml-2 text-green-600">Nạp tiền</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
