<div class="space-y-4">

    <h1 class="text-xl font-semibold mb-4">{{ __('Lịch sử đơn hàng') }}</h1>
    <ul class="space-y-2">
        @foreach($orders as $order)
            <li class="border border-brand-gray p-2 rounded">
                <div>{{ __('Tổng tiền') }}: {{ number_format($order->amount) }} Scoin</div>
                @if($order->licenseKey)
                    <div>{{ __('License') }}: {{ $order->licenseKey->key }}</div>
                @endif
                <ul class="ml-4 list-disc">
                    @foreach($order->items as $item)

                        <li>
                            {{ $item->product->name }} x {{ $item->quantity }}
                            <a href="{{ route('download', $item) }}" class="text-info ml-2">{{ __('Tải file') }}</a>
                        </li>

                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
