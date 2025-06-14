<div class="space-y-2">
    <a href="{{ route('shop.index') }}" wire:navigate class="block px-2 py-1 rounded hover:bg-brand-gray {{ request('category') ? '' : 'bg-brand-gray' }}">All Categories</a>
    @foreach($categories as $cat)
        <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" wire:navigate class="block px-2 py-1 rounded hover:bg-brand-gray {{ request('category') === $cat->slug ? 'bg-brand-gray' : '' }}">
            {{ $cat->name }}
        </a>
    @endforeach
</div>
