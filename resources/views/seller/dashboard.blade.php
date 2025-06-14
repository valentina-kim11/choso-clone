<div>
    <h1 class="text-xl font-semibold mb-4">Tổng quan</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="border border-[#374151] p-4 rounded">
            <p class="text-sm text-gray-400">Doanh thu</p>
            <p class="text-2xl font-semibold">{{ number_format($revenue) }} Scoin</p>
        </div>
        <div class="border border-[#374151] p-4 rounded">
            <p class="text-sm text-gray-400">Đơn hàng</p>
            <p class="text-2xl font-semibold">{{ $orderCount }}</p>
        </div>
        <div class="border border-[#374151] p-4 rounded">
            <p class="text-sm text-gray-400">Sản phẩm</p>
            <p class="text-2xl font-semibold">{{ $productCount }}</p>
        </div>
    </div>

    <h2 class="text-lg font-semibold mb-2">Top sản phẩm</h2>
    <table class="w-full border border-[#374151]">
        <thead>
            <tr>
                <th class="p-2 text-left">Tên</th>
                <th class="p-2 text-center">Số lượt bán</th>
                <th class="p-2 text-right">Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topProducts as $product)
                <tr>
                    <td class="p-2 border-t border-[#374151]">{{ $product->name }}</td>
                    <td class="p-2 border-t border-[#374151] text-center">{{ $product->total_quantity ?? 0 }}</td>
                    <td class="p-2 border-t border-[#374151] text-right">
                        {{ number_format(($product->total_quantity ?? 0) * $product->price) }} Scoin
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
