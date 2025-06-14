<div class="px-4 sm:px-6">
    <h1 class="text-xl font-semibold mb-4">{{ __('My Orders') }}</h1>
    <ul class="space-y-2">
        @foreach($orders as $order)
            <li class="border border-brand-gray p-2 rounded">
                <div class="flex justify-between">
                    <span>{{ $order->buyer->name }}</span>
                    <span>{{ $order->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <ul class="ml-4 list-disc">
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name }} - {{ number_format($item->price) }} Scoin</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
