<div>
    <!-- Email Button -->
    <button wire:click="openModal"
            class="bg-blue-500 text-white px-4 mr-4 hover:cursor-pointer py-2 text-sm rounded hover:bg-blue-600 transition">
        Email
    </button>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click="closeModal">
            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-full max-w-md mx-4" wire:click.stop>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Share Article</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit="sendEmail" class="space-y-4">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Recipient Email *
                        </label>
                        <input type="email"
                               id="email"
                               wire:model="email"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                               placeholder="recipient@example.com"
                               required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Optional Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Optional Message
                        </label>
                        <textarea id="message"
                                  wire:model="message"
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                                  placeholder="Add a personal message (optional)"></textarea>
                        @error('message')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Article Preview -->
                    <div class="bg-gray-50 dark:bg-zinc-700 p-3 rounded-md">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Sharing:</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $article->title }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">By {{ $article->author_name }}</p>
                    </div>

                    <!-- Warning -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-md p-3">
                        <p class="text-xs text-yellow-800 dark:text-yellow-200">
                             The shared link will expire in 24 hours for security.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button"
                                wire:click="closeModal"
                                class="hover:cursor-pointer px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 dark:bg-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-500">
                            Cancel
                        </button>
                        <button type="submit"
                                class="hover:cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
