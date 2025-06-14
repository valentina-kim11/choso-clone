<div>
    <h1 class="text-xl font-semibold mb-4 text-primary">{{ __('Doanh thu') }}</h1>
    <div class="mb-4">
        <select wire:model="filter" class="bg-dark border border-brand-gray p-1 rounded">
            <option value="day">{{ __('Hôm nay') }}</option>
            <option value="month">{{ __('Tháng này') }}</option>
        </select>
    </div>
    <p class="mb-2">{{ __('Tổng tiền') }}: <span class="text-accent">{{ number_format($total) }} Scoin</span></p>
    <div class="bg-dark rounded-2xl shadow p-4 overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr>
                <th class="p-2 text-left">{{ __('Sản phẩm') }}</th>
                <th class="p-2">{{ __('Số lượng') }}</th>
                <th class="p-2">{{ __('Tổng tiền') }}</th>
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
</div>
