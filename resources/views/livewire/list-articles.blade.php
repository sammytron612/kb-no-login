<div class="container mx-auto py-8 px-8">
    <h2 class="text-2xl font-bold mb-4">Articles</h2>
    <div class="space-y-6">
        @foreach ($articles as $article)
            <div class="border shadow-lg rounded-md p-4 pb-4 flex flex-col">
                <div class="flex items-center gap-2">
                    <a href="{{ route('articles.show', $article->id) }}" class="text-blue-500 text-lg font-semibold hover:underline" wire:navigate>{{ $article->title }}</a>
                    <span class="text-gray-400">-</span>
                    <a href="{{ route('articles.edit', $article->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-teal-400 text-white rounded hover:bg-teal-500" title="Edit" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.06 2.06 0 1 1 2.915 2.915L7.5 18.68l-4 1 1-4 12.362-12.193z" />
                        </svg>
                    </a>
                    <a href="#" class="inline-flex items-center justify-center w-8 h-8 bg-red-500 text-white rounded hover:bg-red-600 ml-1" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mt-2">
                    <span class="flex items-center gap-1">
                        <flux:icon.user class="h-4" />
                        Created by {{ $article->author_name }}
                    </span>
                    <span class="flex items-center gap-1">
                        <flux:icon.bookmark class="h-4" />
                        Section: {{ $article->section->section}}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        Views {{ $article->views ?? 0 }}
                    </span>
                    <span class="flex items-center gap-1">
                        <flux:icon.calendar class="h-4"/>
                        {{ $article->created_at->diffForHumans() }}
                    </span>
                    <span class="text-gray-500">-</span>
                    <span class="font-mono text-gray-500 uppercase">{{ $article->kb ?? $article->id }}</span>
                    <span class="flex items-center gap-1">
                        @if(($article->rating ?? 0) > 0)
                            @for($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="{{ $i <= $article->rating ? '#FFD700' : 'none' }}" viewBox="0 0 24 24" stroke="{{ $i <= $article->rating ? '#FFD700' : '#d1d5db' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.75l-6.172 3.245 1.179-6.873L2 9.755l6.9-1.002L12 2.5l3.1 6.253 6.9 1.002-5.007 4.367 1.179 6.873z" />
                                </svg>
                            @endfor
                        @else
                            <span class="text-gray-400">No rating</span>
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</div>
