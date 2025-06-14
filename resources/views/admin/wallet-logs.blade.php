<div>
    <h1 class="text-xl font-semibold mb-4">{{ __('Lịch sử ví') }}</h1>
    <div class="mb-4">
        <input type="number" wire:model="userId" placeholder="{{ __('User ID') }}" class="border border-brand-gray p-1 rounded" />
    </div>
    <div class="border border-brand-gray rounded bg-secondary overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('User') }}</th>
                <th class="p-2">{{ __('Type') }}</th>
                <th class="p-2">{{ __('Amount') }}</th>
                <th class="p-2">{{ __('Description') }}</th>
                <th class="p-2">{{ __('Time') }}</th>
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
</div>
