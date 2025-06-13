<div>
    <h1 class="text-xl font-semibold mb-4">Your Cart</h1>
    <ul>
        @foreach($items as $item)
            <li class="flex justify-between mb-2">
                <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                <button wire:click="remove({{ $item['product']->id }})" class="text-[#EF5350]">Remove</button>
            </li>
        @endforeach
    </ul>
</div>
