
<div class="px-4 sm:px-6">
    <h1 class="text-xl font-semibold mb-4">{{ __('Tổng quan') }}</h1>

<div>
    <h1 class="text-xl font-semibold mb-4 text-primary">{{ __('Tổng quan') }}</h1>


    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-dark rounded-2xl shadow p-4">
            <p class="text-sm text-brand-gray/60">{{ __('Doanh thu') }}</p>
            <p class="text-2xl font-semibold text-accent">{{ number_format($revenue) }} Scoin</p>
        </div>
        <div class="bg-dark rounded-2xl shadow p-4">
            <p class="text-sm text-brand-gray/60">{{ __('Đơn hàng') }}</p>
            <p class="text-2xl font-semibold text-accent">{{ $orderCount }}</p>
        </div>
        <div class="bg-dark rounded-2xl shadow p-4">
            <p class="text-sm text-brand-gray/60">{{ __('Sản phẩm') }}</p>
            <p class="text-2xl font-semibold text-accent">{{ $productCount }}</p>
        </div>
    </div>

    <h2 class="text-lg font-semibold mb-2 text-primary">{{ __('Top sản phẩm') }}</h2>
    <div class="bg-dark rounded-2xl shadow p-4 overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr>
                <th class="p-2 text-left">{{ __('Tên') }}</th>
                <th class="p-2 text-center">{{ __('Số lượt bán') }}</th>
                <th class="p-2 text-right">{{ __('Doanh thu') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topProducts as $product)
                <tr>
                    <td class="p-2 border-t border-brand-gray">{{ $product->name }}</td>
                    <td class="p-2 border-t border-brand-gray text-center">{{ $product->total_quantity ?? 0 }}</td>
                    <td class="p-2 border-t border-brand-gray text-right">
                        {{ number_format(($product->total_quantity ?? 0) * $product->price) }} Scoin
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
