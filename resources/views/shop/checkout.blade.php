<x-layouts.market>
    <div class="space-y-4">
        <h1 class="text-xl font-semibold">{{ session('status') }}</h1>
        @if (!empty($downloads))
            <section class="mt-4 border border-[#374151] p-4 rounded">
                <h2 class="font-semibold mb-2">Your Downloads</h2>
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($downloads as $url)
                        <li><a href="{{ $url }}" class="text-[#4FC3F7] underline">{{ basename(parse_url($url, PHP_URL_PATH)) }}</a></li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
</x-layouts.market>
