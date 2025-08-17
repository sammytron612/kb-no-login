<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-3xl font-bold text-blue-500">{{ $totalArticles }}</span>
                <span class="text-gray-600 dark:text-gray-300 mt-2">Total Articles</span>
            </div>
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-3xl font-bold text-blue-500">{{ $totalViews }}</span>
                <span class="text-gray-600 dark:text-gray-300 mt-2">Total Views</span>
            </div>
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-3xl font-bold text-blue-500">{{ $topAuthor }}</span>
                <span class="text-gray-600 dark:text-gray-300 mt-2">Top Contributor</span>
            </div>
        </div>
        @if (session('success'))
            <div class="p-2 bg-green-100 text-green-800 rounded mb-4 shadow">{{ session('success') }}</div>
        @endif
        <div class="bg-white relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:list-articles />
        </div>
    </div>

</x-layouts.app>
