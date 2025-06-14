<div>
    <h1 class="text-xl font-semibold mb-4">Lịch sử ví</h1>
    <table class="w-full border border-[#374151] text-sm">
        <thead>
            <tr>
                <th class="p-2">Thời gian</th>
                <th class="p-2">Loại</th>
                <th class="p-2">Số tiền</th>
                <th class="p-2">Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td class="p-2 border-t border-[#374151]">{{ $log->created_at }}</td>
                    <td class="p-2 border-t border-[#374151]">{{ $log->type }}</td>
                    <td class="p-2 border-t border-[#374151] text-right">{{ number_format($log->amount) }}</td>
                    <td class="p-2 border-t border-[#374151]">{{ $log->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
