<x-layouts.app>
<div class="container mx-auto py-8">
    <div class="flex items-center mb-4">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Review Article</h1>
    </div>

    <div class="bg-gradient-to-br from-white via-slate-100 to-slate-200 dark:from-zinc-800 dark:via-zinc-900 dark:to-zinc-800 rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-extrabold text-blue-600 dark:text-blue-400 mb-2">{{ $article->title }}</h2>
        <hr class="mb-4">
        <div class="flex flex-wrap items-center text-sm text-zinc-500 dark:text-zinc-400 mb-4 gap-4">
            <span class="flex items-center gap-1"><flux:icon.user /><span class="font-semibold text-lg">Created By: {{ $article->author_name }}</span></span>

            <span class="flex items-center gap-1"><flux:icon.calendar /> <span class="font-semibold">{{ $article->created_at->diffForHumans() }}</span></span>
            <span class="bg-blue-100 dark:bg-blue-900 px-2 py-1 rounded text-xs font-semibold uppercase">{{ $article->kb }}</span>

        </div>
        <div class="mb-4 flex items-center justify-between">
            <dv><span class="font-semibold">Section</span> - <a href="#" class="text-blue-500 underline font-semibold">{{ $article->section ? $article->section->section : '' }}</a></div>
        </div>
        <div class="w-full border p-6 rounded-lg border-slate-300 bg-white dark:bg-zinc-900 prose dark:prose-invert max-w-none mb-6 whitespace-pre-line shadow-sm">
            {!! $article->body ? $article->body->body : '' !!}
        </div>
        <div class="flex gap-4 mt-6">
            <form action="{{ route('approvals.approve', $article->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 hover:cursor-pointer hover:bg-green-400 bg-green-600 text-white rounded hover:bg-green-700">Approve</button>
            </form>
            <form action="{{ route('approvals.reject', $article->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 hover:cursor-pointer hover:bg-red-400 bg-red-600 text-white rounded hover:bg-red-700">Reject</button>
            </form>
        </div>
    </div>
</div>
</x-layouts.app>
