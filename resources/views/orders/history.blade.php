<div class="space-y-4">

    <h1 class="text-xl font-semibold mb-4">Lịch sử đơn hàng</h1>
    <ul class="space-y-2">
        @foreach($orders as $order)
            <li class="border border-[#374151] p-2 rounded">
                <div>Tổng: {{ number_format($order->amount) }} Scoin</div>
                <ul class="ml-4 list-disc">
                    @foreach($order->items as $item)

                        <li>
                            {{ $item->product->name }} x {{ $item->quantity }}
                            <a href="{{ route('download', $item) }}" class="text-[#4FC3F7] ml-2">Tải file</a>
                        </li>

                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
