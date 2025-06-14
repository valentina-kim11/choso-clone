<div>
    <h1 class="text-xl font-semibold mb-4">{{ __('Lịch sử ví') }}</h1>
    <table class="w-full border border-brand-gray text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('Thời gian') }}</th>
                <th class="p-2">{{ __('Loại') }}</th>
                <th class="p-2">{{ __('Số tiền') }}</th>
                <th class="p-2">{{ __('Ghi chú') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td class="p-2 border-t border-brand-gray">{{ $log->created_at }}</td>
                    <td class="p-2 border-t border-brand-gray">{{ $log->type }}</td>
                    <td class="p-2 border-t border-brand-gray text-right">{{ number_format($log->amount) }}</td>
                    <td class="p-2 border-t border-brand-gray">{{ $log->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
