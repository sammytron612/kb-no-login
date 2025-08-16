<x-layouts.app>
<div class="container mx-auto py-8">
    <div class="flex items-center mb-4">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">View article</h1>
        <a href="#" class="ml-auto bg-blue-500 text-white px-2 py-1 text-sm rounded hover:bg-blue-600 transition">Email</a>
    </div>
    <div class="bg-gradient-to-br from-white via-slate-100 to-slate-200 dark:from-zinc-800 dark:via-zinc-900 dark:to-zinc-800 rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-extrabold text-blue-600 dark:text-blue-400 mb-2">{{ $article->title }}</h2>
        <hr class="mb-4">
        <div class="flex flex-wrap items-center text-sm text-zinc-500 dark:text-zinc-400 mb-4 gap-4">
            <span class="flex items-center gap-1"><flux:icon.user /><span class="font-semibold text-lg">{{ $article->author_name }}</span></span>
            <span class="flex items-center gap-1 font-bold">Views <span class="font-semibold">{{ $article->views }}</span></span>
            <span class="flex items-center gap-1"><flux:icon.calendar /></i> <span class="font-semibold">{{ $article->created_at->diffForHumans() }}</span></span>
            <span class="bg-blue-100 dark:bg-blue-900 px-2 py-1 rounded text-xs font-semibold uppercase">{{ $article->kb }}</span>
            <span class="font-semibold">Rating</span>
            <span class="text-yellow-500">
                @for ($i = 1; $i <= 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $i <= round($article->rating) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.75l-6.172 3.245 1.179-6.88L2 9.755l6.904-1.002L12 2.25l3.096 6.503L22 9.755l-5.007 4.36 1.179 6.88z" />
                    </svg>
                @endfor
            </span>
        </div>
        <div class="mb-4 flex items-center justify-between">
            <div><span class="font-semibold">Section</span> - <a href="#" class="text-blue-500 underline font-semibold">{{ $article->section ? $article->section->section : '' }}</a></div>
            <div class="mt-4 gap-4 flex">
                @can('canEditOrDelete', $article)
                    <a href="{{ route('articles.edit', $article->id) }}" class="bg-blue-400 text-white px-4 py-1 text-sm rounded hover:bg-blue-600">Edit</a>
                @endcan
                <a href="#" class="bg-slate-300 text-zinc-700 px-4 py-1 text-sm  rounded hover:bg-slate-500 transition">Print</a>
                @can('canEditOrDelete', $article)
                    <a href="#" class="bg-red-800 text-red-100 hover:text-red-100 px-4 py-1 text-sm  rounded hover:bg-red-700 transition">Delete</a>
                @endcan
            </div>
        </div>
        <div class="w-full border p-6 rounded-lg border-slate-300 bg-white dark:bg-zinc-900 prose dark:prose-invert max-w-none mb-6 whitespace-pre-line shadow-sm">
            {!! $article->body ? $article->body->body : '' !!}
        </div>

    </div>
</div>
</x-layouts.app>
