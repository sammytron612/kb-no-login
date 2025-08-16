<x-layouts.app>
<div class="container mx-auto py-8 px-8">
    <h2 class="text-2xl font-bold mb-4">My Draft Articles</h2>
    <div class="space-y-6">
        @forelse ($drafts as $draft)
            <div class="border shadow-lg rounded-md p-4 pb-4 flex flex-col">
                <div class="flex items-center gap-2">
                    <a href="{{ route('articles.edit', $draft->id) }}" class="text-blue-500 text-lg font-semibold hover:underline">{{ $draft->title }}</a>
                    <span class="text-gray-400">-</span>
                    <a href="{{ route('articles.edit', $draft->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-teal-400 text-white rounded hover:bg-teal-500" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.06 2.06 0 1 1 2.915 2.915L7.5 18.68l-4 1 1-4 12.362-12.193z" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mt-2">
                    <span class="flex items-center gap-1">
                        <flux:icon.user class="h-4" />
                        Created by <span class="font-bold">{{ 'You' }}</span>
                    </span>
                    <span class="flex items-center gap-1">
                        <flux:icon.bookmark class="h-4" />
                        Section:<span class="font-bold"> {{ $draft->section->section ?? 'N/A'}}</span>
                    </span>
                    <span class="flex items-center gap-1">
                        <flux:icon.calendar class="h-4"/>
                        <span>Created:</span>
                        <span class="font-bold">{{ $draft->created_at->diffForHumans() }}</span>
                    </span>
                    <span class="flex items-center gap-1">
                        Last updated:<span class="font-bold"> {{ $draft->updated_at->diffForHumans() }}</span>
                    </span>
                </div>
            </div>
        @empty
            <div class="text-gray-500">You have no draft articles.</div>
        @endforelse
    </div>
</div>
</x-layouts.app>
