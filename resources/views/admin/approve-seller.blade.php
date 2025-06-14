<div>
    <h1 class="text-xl font-semibold mb-4">Duyệt Seller</h1>

    @if(session('status'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('status') }}</div>
    @endif

    <table class="min-w-full bg-white dark:bg-zinc-800 text-sm">
        <thead>
            <tr>
                <th class="p-2">Tên</th>
                <th class="p-2">Email</th>
                <th class="p-2">Ngày đăng ký</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $seller)
                <tr>
                    <td class="p-2">{{ $seller->name }}</td>
                    <td class="p-2">{{ $seller->email }}</td>
                    <td class="p-2">{{ $seller->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">
                        <button wire:click="approve({{ $seller->id }})" class="text-green-600">Duyệt</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
