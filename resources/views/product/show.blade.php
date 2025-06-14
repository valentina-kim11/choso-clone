@push('meta')
<title>{{ $product->name }} | {{ setting('app_name') }}</title>
<meta name="description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
<meta property="og:title" content="{{ $product->name }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
<meta property="og:image" content="{{ $product->cover_url }}">
<meta property="og:url" content="{{ url()->current() }}">
@endpush

<div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
    <div class="md:pr-8">
        <img src="{{ $product->cover_url }}" alt="{{ $product->name }}" class="w-full rounded">
    </div>
    <div class="space-y-6">
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        @if($product->category)
            <p class="text-sm text-brand-gray">{{ $product->category->name }}</p>
        @endif
        <p class="text-accent font-semibold">{{ number_format($product->price) }} Scoin</p>
        <span class="inline-block bg-info text-dark text-xs px-2 py-0.5 rounded">{{ __('Instant download') }}</span>
        <p class="text-sm text-brand-gray">Đã bán: {{ number_format($product->sales_count ?? 0) }} lượt</p>
        <div class="prose prose-invert">
            {!! $product->description !!}
        </div>
        <div class="flex items-center gap-2 mt-4">
            <span class="font-semibold">{{ $product->seller->name }}</span>
        </div>
        <button wire:click="addToCart" class="bg-primary text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-accent">{{ __('Mua ngay') }}</button>
        @if($licenseKey)
            <div class="bg-secondary text-dark p-2 rounded">
                {{ __('License') }}: {{ $licenseKey }}
            </div>
        @endif
    </div>
</div>
