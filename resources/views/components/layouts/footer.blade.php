<footer class="bg-dark text-white p-6 mt-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
        <div>
            <h3 class="font-semibold mb-2">{{ __('Giới thiệu') }}</h3>
            <p class="text-sm">{{ __('Choso Digital Marketplace') }}</p>
        </div>
        <div>
            <h3 class="font-semibold mb-2">{{ __('Hướng dẫn') }}</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="{{ route('orders.history') }}" class="hover:text-accent">{{ __('Đơn hàng') }}</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-semibold mb-2">{{ __('Liên hệ') }}</h3>
            <p class="text-sm">support@example.com</p>
        </div>
    </div>
</footer>
