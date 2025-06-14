<div>
    <h1 class="text-xl font-semibold mb-4">{{ __('Your Cart') }}</h1>
    <ul>
        @foreach($items as $item)
            <li class="flex justify-between mb-2">
                <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                <button wire:click="remove({{ $item['product']->id }})" class="text-danger">{{ __('Remove') }}</button>
            </li>
        @endforeach
    </ul>


    <div class="mt-4 font-semibold">
        {{ __('Total') }}: {{ number_format(collect($items)->sum(fn($i) => $i['product']->price * $i['quantity'])) }} Scoin
    </div>
    <a href="{{ route('shop.checkout') }}" wire:navigate class="mt-2 inline-block bg-primary text-white px-2 py-1 rounded">{{ __('Checkout') }}</a>


</div>
