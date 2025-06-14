<div class="space-y-4 px-4 sm:px-6">
    <h1 class="text-xl font-semibold text-center">{{ __('Cảm ơn bạn đã mua hàng') }}</h1>
    @if($order)
        <ul class="space-y-2">
            @foreach($order->items as $item)
                <li class="flex justify-between">
                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                    <a href="{{ route('download', $item) }}" class="text-info">{{ __('Tải file') }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
