<div>
    <h1 class="text-xl font-semibold mb-4">{{ __('Manage Coupons') }}</h1>

    @if(session('status'))
        <div class="mb-4 text-info">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mb-4 space-y-2">
        <div class="space-x-2">
            <input type="text" wire:model="code" placeholder="{{ __('Code') }}" class="border p-1 rounded" />
            <select wire:model="type" class="border p-1 rounded">
                <option value="percent">{{ __('Percent') }}</option>
                <option value="fixed">{{ __('Fixed') }}</option>
            </select>
            <input type="number" wire:model="value" placeholder="{{ __('Value') }}" class="border p-1 rounded w-24" step="0.01" />
            <input type="date" wire:model="expires_at" class="border p-1 rounded" />
            <input type="number" wire:model="usage_limit" placeholder="{{ __('Usage limit') }}" class="border p-1 rounded w-24" />
            <button type="submit" class="bg-primary text-white px-3 py-1 rounded">{{ $editingId ? __('Update') : __('Add') }}</button>
            @if($editingId)
                <button type="button" wire:click="$set('editingId', null)" class="px-2">{{ __('Cancel') }}</button>
            @endif
        </div>
    </form>

    <table class="min-w-full bg-white dark:bg-brand-gray text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('Code') }}</th>
                <th class="p-2">{{ __('Type') }}</th>
                <th class="p-2">{{ __('Value') }}</th>
                <th class="p-2">{{ __('Expires') }}</th>
                <th class="p-2">{{ __('Used') }}</th>
                <th class="p-2">{{ __('Status') }}</th>
                <th class="p-2">{{ __('Action') }}</th>
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
                            {{ __('Expired') }}
                        @elseif($coupon->isMaxed())
                            {{ __('Limit reached') }}
                        @else
                            {{ __('Active') }}
                        @endif
                    </td>
                    <td class="p-2 space-x-2">
                        <button wire:click="edit({{ $coupon->id }})" class="text-info">{{ __('Edit') }}</button>
                        <button wire:click="delete({{ $coupon->id }})" class="text-danger">{{ __('Delete') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
