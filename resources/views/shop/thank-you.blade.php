<div class="space-y-4">
    <h1 class="text-xl font-semibold text-center">Cảm ơn bạn đã mua hàng</h1>
    @if($order)
        <ul class="space-y-2">
            @foreach($order->items as $item)
                <li class="flex justify-between">
                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>

                    <a href="{{ route('download', $item) }}" class="text-[#4FC3F7]">Tải file</a>


                    <a href="{{ \Illuminate\Support\Facades\Storage::url($item->product->file_path) }}" class="text-[#4FC3F7]">Tải file</a>

                    <a href="#" class="text-[#4FC3F7]">Tải file</a>


                </li>
            @endforeach
        </ul>
    @endif
</div>
