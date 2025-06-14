<div>
    <h1 class="text-xl font-semibold mb-4">Lịch sử ví</h1>
    <div class="mb-4">
        <input type="number" wire:model="userId" placeholder="User ID" class="border p-1 rounded" />
    </div>
    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">User</th>
                <th class="p-2">Type</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Description</th>
                <th class="p-2">Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td class="p-2">{{ $log->user->name }}</td>
                    <td class="p-2">{{ $log->type }}</td>
                    <td class="p-2">{{ $log->amount }}</td>
                    <td class="p-2">{{ $log->description }}</td>
                    <td class="p-2">{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
