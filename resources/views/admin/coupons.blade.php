<div>
    <h1 class="text-xl font-semibold mb-4">Manage Coupons</h1>

    @if(session('status'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mb-4 space-y-2">
        <div class="space-x-2">
            <input type="text" wire:model="code" placeholder="Code" class="border p-1 rounded" />
            <select wire:model="type" class="border p-1 rounded">
                <option value="percent">Percent</option>
                <option value="fixed">Fixed</option>
            </select>
            <input type="number" wire:model="value" placeholder="Value" class="border p-1 rounded w-24" step="0.01" />
            <input type="date" wire:model="expires_at" class="border p-1 rounded" />
            <input type="number" wire:model="usage_limit" placeholder="Usage limit" class="border p-1 rounded w-24" />
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">{{ $editingId ? 'Update' : 'Add' }}</button>
            @if($editingId)
                <button type="button" wire:click="$set('editingId', null)" class="px-2">Cancel</button>
            @endif
        </div>
    </form>

    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">Code</th>
                <th class="p-2">Type</th>
                <th class="p-2">Value</th>
                <th class="p-2">Expires</th>
                <th class="p-2">Used</th>
                <th class="p-2">Status</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td class="p-2">{{ $coupon->code }}</td>
                    <td class="p-2">{{ $coupon->type }}</td>
                    <td class="p-2">{{ $coupon->value }}</td>
                    <td class="p-2">{{ $coupon->expires_at?->format('Y-m-d') ?? '-' }}</td>
                    <td class="p-2">{{ $coupon->used }}{{ $coupon->usage_limit ? ' / ' . $coupon->usage_limit : '' }}</td>
                    <td class="p-2">
                        @if($coupon->isExpired())
                            Expired
                        @elseif($coupon->isMaxed())
                            Limit reached
                        @else
                            Active
                        @endif
                    </td>
                    <td class="p-2 space-x-2">
                        <button wire:click="edit({{ $coupon->id }})" class="text-blue-500">Edit</button>
                        <button wire:click="delete({{ $coupon->id }})" class="text-red-600">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
