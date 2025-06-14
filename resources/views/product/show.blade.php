@push('meta')
<title>{{ $product->name }} | {{ setting('app_name') }}</title>
<meta name="description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
<meta property="og:title" content="{{ $product->name }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
<meta property="og:image" content="{{ $product->cover_url }}">
<meta property="og:url" content="{{ url()->current() }}">
@endpush

<div class="max-w-5xl mx-auto grid gap-8 md:grid-cols-2">
    <div>
        <img src="{{ $product->cover_url }}" alt="{{ $product->name }}" class="w-full rounded">
    </div>
    <div class="space-y-6">
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        @if($product->category)
            <p class="text-sm text-brand-gray">{{ $product->category->name }}</p>
        @endif
        <div class="prose prose-invert">
            {!! $product->description !!}
        </div>
        <div class="flex items-center gap-2 mt-4">
            <span class="font-semibold">{{ $product->seller->name }}</span>
        </div>
        <button wire:click="addToCart" class="bg-primary text-white px-4 py-2 rounded">Mua ngay</button>
        @if($licenseKey)
            <div class="bg-secondary text-dark p-2 rounded">
                License: {{ $licenseKey }}
            </div>
        @endif
    </div>
</div>
