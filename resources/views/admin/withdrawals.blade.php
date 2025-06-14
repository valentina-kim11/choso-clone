<div>
    <h1 class="text-xl font-semibold mb-4">{{ __('Yêu cầu rút tiền') }}</h1>
    <table class="min-w-full bg-white dark:bg-brand-gray text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('User') }}</th>
                <th class="p-2">{{ __('Amount') }}</th>
                <th class="p-2">{{ __('Status') }}</th>
                <th class="p-2">{{ __('Action') }}</th>
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
                            <button wire:click="approve({{ $withdrawal->id }})" class="text-info">{{ __('Duyệt') }}</button>
                            <button wire:click="reject({{ $withdrawal->id }})" class="text-danger">{{ __('Từ chối') }}</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
