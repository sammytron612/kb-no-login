<x-layouts.app>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Site Stats</h1>
    <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center">
            <span class="text-3xl font-bold text-blue-500">{{ $totalArticles }}</span>
            <span class="text-gray-600 dark:text-gray-300 mt-2">Total Articles</span>
        </div>
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center">
            <span class="text-3xl font-bold text-blue-500">{{ $totalViews }}</span>
            <span class="text-gray-600 dark:text-gray-300 mt-2">Total Views</span>
        </div>
    </div>
    <h2 class="text-xl font-semibold mb-4">Top 5 Most Viewed Articles</h2>
    <div class="grid gap-4">
        @foreach ($topArticles as $article)
            <div class="bg-white dark:bg-zinc-800 rounded shadow p-4 flex justify-between items-center">
                <span class="font-semibold text-blue-600">{{ $article->title }}</span>
                <span class="text-gray-500">Views: {{ $article->views }}</span>
            </div>
        @endforeach
    </div>
    <div>
        <canvas id="mostViewedChart" class="w-full h-full"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/dashboard-charts.js"></script>
</x-layouts.app>
