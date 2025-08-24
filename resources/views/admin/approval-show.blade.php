{{-- filepath: resources/views/admin/approval-show.blade.php --}}
<x-layouts.app.main :title="__('Review Article')">
    <div class="max-w-6xl mx-auto py-8 px-4" x-data="{ rejectModal: false }">
        <!-- Header Section with Navigation -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('admin.approvals') }}"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Approvals
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Review Article
                </h1>
            </div>

            <!-- Status Badge -->
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    Pending Approval
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    {{ $article->kb }}
                </span>
            </div>
        </div>

        <!-- Article Content Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 overflow-hidden mb-6">
            <!-- Article Header -->
            <div class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-700 dark:to-zinc-800 px-8 py-6 border-b border-gray-200 dark:border-zinc-700">
                <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">{{ $article->title }}</h2>

                <!-- Meta Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Author</div>
                            <div class="text-blue-600 dark:text-blue-400 font-semibold">{{ $article->author_name }}</div>
                        </div>
                    </div>

                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Created</div>
                            <div>{{ $article->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Section</div>
                            <div class="text-blue-600 dark:text-blue-400 font-semibold">
                                {{ $article->section ? $article->section->section : 'No section' }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 14a4 4 0 01-4-4v-4a4 4 0 014-4 4 4 0 014 4v4a4 4 0 01-4 4z"></path>
                        </svg>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Scope</div>
                            <div class="text-green-600 dark:text-green-400 font-semibold">
                                {{ $article->scope == 1 ? 'Public' : 'Private' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tags Section -->
                @if($article->tags && count($article->tags) > 0)
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-zinc-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tags:</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach($article->tags as $tag)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 rounded-md">
                                        {{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Article Content -->
            <div class="px-8 py-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Article Content
                </h3>
                <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-600 rounded-lg p-6 prose dark:prose-invert max-w-none shadow-sm">
                    {!! $article->body ? $article->body->body : '<p class="text-gray-500 italic">No content available</p>' !!}
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Review Decision</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Choose whether to approve or reject this article submission.</p>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Reject Button - Opens Modal -->
                    <button type="button"
                            @click="rejectModal = true"
                            class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reject Article
                    </button>

                    <!-- Approve Button -->
                    <form action="{{ route('approvals.approve', $article->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to approve this article?')"
                                class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approve Article
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Rejection Modal with Alpine.js -->

        <div x-show="rejectModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="rejectModal = false"
             @click="rejectModal = false"
             class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
             style="display: none;">

            <div @click.stop
                 x-show="rejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white dark:bg-zinc-800">

                <div class="mt-3">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Reject Article
                        </h3>
                        <button @click="rejectModal = false"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form action="{{ route('approvals.reject', $article->id) }}" method="POST" x-data="{ rejectionReason: '' }">
                        @csrf
                        <div class="mb-4">
                            <label for="rejection_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Rejection Reason <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="rejection_reason"
                                id="rejection_reason"
                                x-model="rejectionReason"
                                x-init="$nextTick(() => $el.focus())"
                                @input="if (rejectionReason.length > 200) rejectionReason = rejectionReason.slice(0, 200)"
                                maxlength="200"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:text-white resize-none"
                                rows="5"
                                placeholder="Please provide a brief explanation for why this article is being rejected (max 200 characters)."
                                required
                            ></textarea>

                            <!-- Character Counter with Color Change -->
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Be specific and constructive to help the author improve.
                                </p>
                                <div class="text-xs font-medium"
                                     :class="rejectionReason.length >= 180 ? 'text-red-500' : rejectionReason.length >= 150 ? 'text-yellow-500' : 'text-gray-500 dark:text-gray-400'">
                                    <span x-text="rejectionReason.length"></span>/200
                                </div>
                            </div>

                            <!-- Warning when approaching limit -->
                            <div x-show="rejectionReason.length >= 180"
                                 x-transition
                                 class="mt-1 text-xs text-red-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"></path>
                                </svg>
                                Character limit almost reached
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-zinc-600">
                            <button
                                type="button"
                                @click="rejectModal = false; rejectionReason = ''"
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 rounded-md hover:bg-gray-200 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-200">
                                Cancel
                            </button>
                            <button
                                type="submit"
                                :disabled="rejectionReason.trim().length === 0 || rejectionReason.length > 200"
                                :class="{
                                    'opacity-50 cursor-not-allowed': rejectionReason.trim().length === 0 || rejectionReason.length > 200,
                                    'hover:bg-red-700': rejectionReason.trim().length > 0 && rejectionReason.length <= 200
                                }"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app.main>
