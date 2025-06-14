<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
    <div class="flex">
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="font-bold block mb-4">Admin</a>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block">Dashboard</a>
                <a href="{{ route('admin.withdrawals') }}" class="block">Yêu cầu rút tiền</a>

                <a href="{{ route('admin.wallet-logs') }}" class="block">Lịch sử ví</a>


                <a href="{{ route('admin.topup-wallet') }}" class="block">Nạp ví cho user</a>

                <a href="{{ route('admin.approve-sellers') }}" class="block">Duyệt Seller</a>

                <a href="{{ route('admin.categories') }}" class="block">Categories</a>
                <a href="{{ route('admin.coupons') }}" class="block">Coupons</a>


            </nav>
        </aside>
        <div class="flex-1 flex flex-col">
            <x-layouts.header />
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
            <x-layouts.footer />
        </div>
    </div>
    @fluxScripts
</body>
</html>
