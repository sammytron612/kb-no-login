<x-layouts.app>
<div class="container mx-auto py-8 px-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-600">Approvals</h2>
    @if (session('success'))
        <div class="p-2 bg-green-100 text-green-800 rounded mb-4 shadow">{{ session('success') }}</div>
    @endif
    <div class="space-y-6">
        @forelse($articles as $article)
            <div class="border shadow-lg bg-white rounded-md p-4 pb-4 flex flex-col">
                <div class="flex items-center gap-2">
                    <span class="text-blue-500 text-lg font-semibold">{{ $article->title }}</span>
                    <span class="text-gray-400">-</span>
                    <a href="{{ route('approvals.show', $article->id) }}" class="inline-flex items-center justify-center w-16 h-8 bg-teal-400 text-white rounded hover:bg-teal-500 ml-2" title="Review">
                        Review
                    </a>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mt-2">
                    <span class="flex items-center gap-1">
                        <flux:icon.user class="h-4" />
                        Created by {{ $article->author_name }}
                    </span>
                    <span class="flex items-center gap-1">
                        <flux:icon.bookmark class="h-4" />
                        Section: {{ $article->section->section ?? 'N/A'}}
                    </span>

                    <span class="flex items-center gap-1">
                        <flux:icon.calendar class="h-4"/>
                        {{ $article->created_at->diffForHumans() }}
                    </span>
                    <span class="flex items-center gap-1">
                        Last updated: {{ $article->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-gray-500">No articles are waiting for approval.</div>
        @endforelse
    </div>
</div>
</x-layouts.app>
