<div class="max-w-3xl mx-auto py-8">
    <div class="mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search articles..." class="w-full px-5 py-3 border border-slate-300 rounded-lg shadow focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition" />
    </div>
    <div class="grid gap-6">
        @if($articles)
             @forelse ($articles as $article)
                <div class="border border-slate-200 bg-white dark:from-zinc-800 dark:via-zinc-900 dark:to-zinc-800 shadow-lg rounded-xl p-6 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 text-xl font-bold hover:underline">{{ $article->title }}</a>
                        <span class="text-gray-400">•</span>
                        <a href="{{ route('articles.edit', $article->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.06 2.06 0 1 1 2.915 2.915L7.5 18.68l-4 1 1-4 12.362-12.193z" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mt-2">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.657 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span class="font-semibold">{{ $article->author_name }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            Views <span class="font-semibold">{{ $article->views ?? 0 }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <span class="font-semibold">{{ $article->created_at->diffForHumans() }}</span>
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="font-mono text-gray-500">{{ $article->kb ?? $article->id }}</span>
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
            @empty
            <div class="mt-4 text-center text-gray-500">
                <span class="text-sm">No articles found.</span>
            </div>
             @endforelse
    </div>
    @if($articles)
        <div class="mt-8 flex justify-center">
            {{ $articles->links() }}
        </div>
    @endif
    @endif
</div>
