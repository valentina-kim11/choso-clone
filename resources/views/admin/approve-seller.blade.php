<div>
    <h1 class="text-xl font-semibold mb-4 text-primary">{{ __('Duyệt Seller') }}</h1>

    @if(session('status'))
        <div class="mb-4 text-info">{{ session('status') }}</div>
    @endif

    <div class="bg-dark rounded-2xl shadow p-4 overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead>
            <tr>
                <th class="p-2">{{ __('Tên') }}</th>
                <th class="p-2">{{ __('Email') }}</th>
                <th class="p-2">{{ __('Ngày đăng ký') }}</th>
                <th class="p-2">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $seller)
                <tr>
                    <td class="p-2">{{ $seller->name }}</td>
                    <td class="p-2">{{ $seller->email }}</td>
                    <td class="p-2">{{ $seller->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">
                        <button wire:click="approve({{ $seller->id }})" class="bg-info text-dark px-2 py-1 rounded">{{ __('Duyệt') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
