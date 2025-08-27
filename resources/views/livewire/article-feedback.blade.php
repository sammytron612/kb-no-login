<div class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 mt-8">
    <h3 class="text-lg font-bold mb-4 text-blue-600 dark:text-blue-400">Rate & Comment</h3>
    @if ($success)
        <div class="p-3 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-lg mb-4 border border-green-200 dark:border-green-800">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Thank you for your feedback!
            </div>
        </div>
    @endif
    <form wire:submit.prevent="submitFeedback" class="space-y-6">
        <div>
            <label class="block font-semibold mb-3 text-gray-700 dark:text-gray-300">Rating</label>
            <div class="flex gap-1 items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <button
                        type="button"
                        wire:click="$set('rating', {{ $i }})"
                        class="group transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-lg p-1"
                        title="Rate {{ $i }} star{{ $i > 1 ? 's' : '' }}"
                    >
                        <svg
                            class="w-8 h-8 transition-colors duration-200 {{ $rating >= $i ? 'text-yellow-400 drop-shadow-sm' : 'text-gray-300 dark:text-gray-600 group-hover:text-yellow-300' }}"
                            fill="{{ $rating >= $i ? 'currentColor' : 'none' }}"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </button>
                @endfor
                @if($rating > 0)
                    <span class="ml-3 text-sm font-medium text-gray-600 dark:text-gray-400">
                        {{ $rating }} out of 5 stars
                    </span>
                @endif
            </div>
            @error('rating')
                <span class="text-red-600 dark:text-red-400 text-sm mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-3 text-gray-700 dark:text-gray-300">Comment</label>
            <textarea
                wire:model.defer="comment"
                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 rounded-lg p-4 h-32 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 transition-colors duration-200 resize-none"
                placeholder="Share your thoughts about this article..."
            ></textarea>
            @error('comment')
                <span class="text-red-600 dark:text-red-400 text-sm mt-1 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="flex justify-end">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
            >
                Submit Feedback
            </button>
        </div>
    </form>
</div>
