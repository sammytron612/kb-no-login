<x-layouts.app>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">My Drafts</h1>
    <div class="grid gap-6">
        @forelse ($drafts as $article)
            <div class="border border-slate-200 bg-white dark:bg-zinc-800 shadow rounded-xl p-6 flex flex-col">
                <div class="flex items-center gap-2 mb-2">
                    <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-600 text-xl font-bold hover:underline">{{ $article->title }}</a>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mt-2">
                    <span class="font-semibold">Section:</span> {{ $article->section->section }}
                    <span class="font-semibold">Created:</span> {{ $article->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">No drafts found.</div>
        @endforelse
    </div>
</div>
</x-layouts.app>
