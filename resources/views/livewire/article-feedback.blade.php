<div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 mt-8">
    <h3 class="text-lg font-bold mb-4 text-blue-600">Rate & Comment</h3>
    @if ($success)
        <div class="p-2 bg-green-100 text-green-800 rounded mb-4">Thank you for your feedback!</div>
    @endif
    <form wire:submit.prevent="submitFeedback" class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Rating</label>
            <div class="flex gap-1">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button" wire:click="$set('rating', {{ $i }})" class="w-8 h-8 rounded-full border-2 @if($rating >= $i) border-yellow-400 bg-yellow-300 @else border-gray-300 bg-gray-100 @endif flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $rating >= $i ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-yellow-500 hover:cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.75l-6.172 3.245 1.179-6.88L2 9.755l6.904-1.002L12 2.25l3.096 6.503L22 9.755l-5.007 4.36 1.179 6.88z" />
                        </svg>
                    </button>
                @endfor
            </div>
            @error('rating') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Comment</label>
            <textarea wire:model.defer="comment" class="w-full border border-slate-300 rounded-lg p-3 h-24 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">Submit</button>
    </form>
</div>
