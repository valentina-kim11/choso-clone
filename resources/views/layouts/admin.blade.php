<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-secondary dark:bg-dark text-dark dark:text-white">
    <div class="flex flex-col sm:flex-row">
        <aside class="hidden sm:block sm:w-64 bg-brand-gray text-white min-h-screen p-4 space-y-2 dark:bg-brand-gray">
            <a href="{{ route('admin.dashboard') }}" class="font-bold block mb-4">{{ __('Admin') }}</a>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block">{{ __('Dashboard') }}</a>
                <a href="{{ route('admin.withdrawals') }}" class="block">{{ __('Yêu cầu rút tiền') }}</a>

                <a href="{{ route('admin.wallet-logs') }}" class="block">{{ __('Lịch sử ví') }}</a>


                <a href="{{ route('admin.topup-wallet') }}" class="block">{{ __('Nạp ví cho user') }}</a>

                <a href="{{ route('admin.approve-sellers') }}" class="block">{{ __('Duyệt Seller') }}</a>

                <a href="{{ route('admin.categories') }}" class="block">{{ __('Categories') }}</a>
                <a href="{{ route('admin.coupons') }}" class="block">{{ __('Coupons') }}</a>


            </nav>
        </aside>
        <div class="flex-1 flex flex-col">
            <livewire:header />
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
            <x-layouts.footer />
        </div>
    </div>
    @fluxScripts
</body>
</html>
