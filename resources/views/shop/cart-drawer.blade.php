<div
    x-data="{ open: @entangle('open') }"
    class="fixed top-16 bottom-0 right-0 w-64 bg-dark border-l border-brand-gray p-4 overflow-y-auto transform transition-transform duration-300 translate-x-full"
    :class="{ 'translate-x-0': open }"
>
    <livewire:shop.cart />
</div>
