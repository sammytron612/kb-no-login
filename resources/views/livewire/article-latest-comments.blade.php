<div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 mt-8">
    <h3 class="text-lg font-bold mb-4 text-blue-600">Latest Comments</h3>
    @forelse ($comments as $comment)
        <div class="mb-4 border-b pb-4">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-semibold text-zinc-900 dark:text-white">{{ $comment->user->name }}</span>
                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex items-center gap-1 mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $i <= $comment->rating ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.75l-6.172 3.245 1.179-6.88L2 9.755l6.904-1.002L12 2.25l3.096 6.503L22 9.755l-5.007 4.36 1.179 6.88z" />
                    </svg>
                @endfor
            </div>
            <div class="text-gray-700 dark:text-gray-200">{{ $comment->comment }}</div>
        </div>
    @empty
        <div class="text-gray-500">No comments yet.</div>
    @endforelse
</div>
