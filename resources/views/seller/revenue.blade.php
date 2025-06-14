<div>
    <h1 class="text-xl font-semibold mb-4">Doanh thu</h1>
    <div class="mb-4">
        <select wire:model="filter" class="bg-dark border border-brand-gray p-1 rounded">
            <option value="day">Hôm nay</option>
            <option value="month">Tháng này</option>
        </select>
    </div>
    <p class="mb-2">Tổng: {{ number_format($total) }} Scoin</p>
    <table class="w-full border border-brand-gray">
        <thead>
            <tr>
                <th class="p-2 text-left">Sản phẩm</th>
                <th class="p-2">Số lượng</th>
                <th class="p-2">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summary as $item)
                <tr>
                    <td class="p-2 border-t border-brand-gray">{{ $item['product']->name }}</td>
                    <td class="p-2 border-t border-brand-gray text-center">{{ $item['quantity'] }}</td>
                    <td class="p-2 border-t border-brand-gray text-right">{{ number_format($item['amount']) }} Scoin</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
