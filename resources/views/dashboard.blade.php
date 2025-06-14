<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-brand-gray/30 dark:border-brand-gray/60">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-brand-gray/50 dark:stroke-secondary/50" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-brand-gray/30 dark:border-brand-gray/60">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-brand-gray/50 dark:stroke-secondary/50" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-brand-gray/30 dark:border-brand-gray/60">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-brand-gray/50 dark:stroke-secondary/50" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-brand-gray/30 dark:border-brand-gray/60">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-brand-gray/50 dark:stroke-secondary/50" />
        </div>
    </div>
</x-layouts.app>
