<div class="space-y-4">

    <h1 class="text-xl font-semibold mb-4">Lịch sử đơn hàng</h1>
    <ul class="space-y-2">
        @foreach($orders as $order)
            <li class="border border-[#374151] p-2 rounded">
                <div>Tổng: {{ number_format($order->amount) }} Scoin</div>
                <ul class="ml-4 list-disc">
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name }} x {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>

    <h1 class="text-xl font-semibold">Order History</h1>
    @foreach($orders as $order)
        <div class="border border-[#374151] p-4 rounded">
            <p class="font-semibold">Order #{{ $order->id }} - {{ number_format($order->amount) }} Scoin</p>
            <ul class="ml-4 list-disc">
                @foreach($order->items as $item)
                    <li>
                        {{ $item->product->name }} x {{ $item->quantity }} ({{ number_format($item->price) }} each)
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

</div>
