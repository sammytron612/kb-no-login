<x-layouts.app :title="__('Review Article')">
    <div class="max-w-6xl mx-auto py-8 px-4">
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

            <!-- Attachments Section -->
            @if(!empty($article->attachments) && count($article->attachments) > 0)
                <div class="px-8 py-6 bg-blue-50 dark:bg-blue-900/20 border-b border-gray-200 dark:border-zinc-700">
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        Attachments ({{ count($article->attachments) }})
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($article->attachments as $attachment)
                            @php
                                $filename = basename($attachment);
                                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                                $icon = match($extension) {
                                    'pdf' => '📄',
                                    'doc', 'docx' => '📝',
                                    'xls', 'xlsx' => '📊',
                                    'ppt', 'pptx' => '📋',
                                    'txt' => '📃',
                                    'zip', 'rar', '7z' => '🗜️',
                                    'jpg', 'jpeg', 'png', 'gif', 'bmp' => '🖼️',
                                    default => '📎'
                                };
                            @endphp

                            <a href="{{ asset('storage/' . $attachment) }}"
                               target="_blank"
                               class="flex items-center p-3 border border-gray-200 dark:border-zinc-600 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors duration-200 group">
                                <span class="text-2xl mr-3 flex-shrink-0">{{ $icon }}</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100 truncate group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                        {{ $filename }}
                                    </p>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500 uppercase">{{ $extension }}</p>
                                </div>
                                <svg class="w-4 h-4 text-zinc-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

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
                    <form action="{{ route('approvals.reject', $article->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to reject this article?')"
                                class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Article
                        </button>
                    </form>

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

        <!-- Additional Actions -->
        <div class="mt-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('articles.show', $article->id) }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-700 border border-gray-300 dark:border-zinc-600 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-600 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View as Public
                </a>

                <a href="{{ route('articles.edit', $article->id) }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Article
                </a>
            </div>

            <span class="text-sm text-gray-500 dark:text-gray-400">
                Submitted {{ $article->created_at->format('M j, Y \a\t g:i A') }}
            </span>
        </div>
    </div>
</x-layouts.app>
