<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#111827] text-white">
        <header class="bg-[#00796B] p-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-bold" wire:navigate>Choso</a>
            <nav class="flex gap-4">
                @auth
                    @if(auth()->user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}" wire:navigate>Seller Dashboard</a>
                        <a href="{{ route('seller.revenue') }}" wire:navigate>Doanh thu</a>
                        <a href="{{ route('seller.withdraw') }}" wire:navigate>Rút Scoin</a>
                        <a href="{{ route('seller.wallet-logs') }}" wire:navigate>Lịch sử ví</a>
                    @else
                        <a href="{{ route('shop.wallet-logs') }}" wire:navigate>Lịch sử ví</a>
                    @endif

                    <a href="{{ route('orders.history') }}" wire:navigate>Order History</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                @else
                    <a href="{{ route('login') }}" wire:navigate>Login</a>
                @endauth
            </nav>
        </header>
        <main class="p-6">
            {{ $slot }}
        </main>
        <aside class="fixed top-16 right-0 w-64 h-full bg-[#111827] border-l border-[#374151] p-4 overflow-y-auto">
            <livewire:shop.cart />
        </aside>
        @fluxScripts
    </body>
</html>
