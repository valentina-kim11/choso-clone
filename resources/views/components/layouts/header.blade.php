<header class="bg-primary p-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="font-bold" wire:navigate>{{ __('Choso') }}</a>
    <nav class="flex items-center gap-4">
        @auth
            @if(auth()->user()->role === 'seller')
                <a href="{{ route('seller.dashboard') }}" wire:navigate>{{ __('Tổng quan') }}</a>
                <a href="{{ route('seller.revenue') }}" wire:navigate>{{ __('Doanh thu') }}</a>
                <a href="{{ route('seller.coupons') }}" wire:navigate>{{ __('Coupons') }}</a>
                <a href="{{ route('seller.withdraw') }}" wire:navigate>{{ __('Rút Scoin') }}</a>
                <a href="{{ route('seller.wallet-logs') }}" wire:navigate>{{ __('Lịch sử ví') }}</a>
            @else
                <a href="{{ route('shop.wallet-logs') }}" wire:navigate>{{ __('Lịch sử ví') }}</a>
            @endif
            <a href="{{ route('orders.history') }}" wire:navigate>{{ __('Order History') }}</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
        @else
            <a href="{{ route('login') }}" wire:navigate>{{ __('Login') }}</a>
        @endauth
        <button type="button" class="relative" x-data @click="$dispatch('toggle-cart')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 2.25h1.591c.46 0 .868.314.978.761L5.94 7.5m0 0H19.5l-.862 4.311a1.5 1.5 0 01-1.478 1.189H7.125a1.5 1.5 0 01-1.478-1.189L5.94 7.5m0 0L5.25 4.5m0 0L4.219 2.435A.75.75 0 003.5 2.25H2.25m8.25 18.75a.75.75 0 100-1.5.75.75 0 000 1.5zm6.75 0a.75.75 0 100-1.5.75.75 0 000 1.5z" />
            </svg>
            <span class="absolute -top-1 -right-2 bg-red-600 text-xs rounded-full px-1">
                {{ $count }}
            </span>
        </button>
    </nav>
</header>
