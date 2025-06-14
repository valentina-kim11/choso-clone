<div
    x-data="{ open: @entangle('open') }"
    class="relative w-full lg:w-64 bg-dark border-t lg:border-t-0 lg:border-l border-brand-gray p-4 overflow-y-auto transform transition-transform duration-300 translate-x-full"
    :class="{ 'translate-x-0': open }"
>
    <livewire:shop.cart />
</div>
