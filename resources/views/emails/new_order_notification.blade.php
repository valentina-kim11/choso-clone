<div>
    <p>📦 {{ __('Đơn hàng mới từ') }} {{ $order->buyer->email }}</p>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->product->name }} x {{ $item->quantity }} - {{ number_format($item->price) }}đ</li>
        @endforeach
    </ul>
    <p>{{ __('Total') }}: {{ number_format($order->amount) }}đ</p>
</div>
