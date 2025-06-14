<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#111827] text-white">
        <x-layouts.header />
        <main class="p-6">
            {{ $slot }}
        </main>
        <aside class="fixed top-16 right-0 w-64 h-full bg-[#111827] border-l border-[#374151] p-4 overflow-y-auto">
            <livewire:shop.cart />
        </aside>
        <x-layouts.footer />
        @fluxScripts
    </body>
</html>
