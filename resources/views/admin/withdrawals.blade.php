<div>
    <h1 class="text-xl font-semibold mb-4">Yêu cầu rút tiền</h1>
    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">User</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Status</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($withdrawals as $withdrawal)
                <tr>
                    <td class="p-2">{{ $withdrawal->user->name }}</td>
                    <td class="p-2">{{ $withdrawal->amount }}</td>
                    <td class="p-2">{{ $withdrawal->status }}</td>
                    <td class="p-2 space-x-2">
                        @if($withdrawal->status === 'pending')
                            <button wire:click="approve({{ $withdrawal->id }})" class="text-green-600">Duyệt</button>
                            <button wire:click="reject({{ $withdrawal->id }})" class="text-red-600">Từ chối</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
