<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-dark text-white" x-data="{ filtersOpen: false }">
        <livewire:header />
        <div class="flex">
            <aside class="hidden md:block w-64 border-r border-brand-gray p-4">
                <livewire:shop.category-filter />
            </aside>
            <main class="flex-1 p-6">
                <button class="md:hidden mb-4" @click="filtersOpen = !filtersOpen">{{ __('Categories') }}</button>
                <div x-show="filtersOpen" class="md:hidden mb-4 border border-brand-gray p-4">
                    <livewire:shop.category-filter />
                </div>
                {{ $slot }}
            </main>
            <livewire:shop.cart-drawer />
        </div>
        <x-layouts.footer />
        @fluxScripts
    </body>
</html>
