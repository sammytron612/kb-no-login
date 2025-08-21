<x-layouts.app :title="__('Create Article')">
    <div class="max-w-6xl mx-auto py-8 px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Create New Article</h1>
            <p class="text-gray-600 dark:text-gray-300">Share your knowledge with the community</p>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-xl shadow-lg flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 space-y-2">
                @foreach ($errors->all() as $error)
                    <div class="p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-xl shadow-lg flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                        </svg>
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Main Form Container -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Article Details
                </h2>
                <p class="text-blue-100 text-sm mt-1">Fill in the information below to create your article</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Basic Information Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Title -->
                        <div class="lg:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Article Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200"
                                   placeholder="Enter a descriptive title for your article..."
                                   required value="{{ old('title') }}" />
                            @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Section -->
                        <div>
                            <label for="section" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Section <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="section" id="section"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200"
                                   placeholder="e.g., Technical Support, User Guide..."
                                   required value="{{ old('section') }}" />
                            @error('section') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Tags
                            </label>
                            <input type="text" name="tags" id="tags"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200"
                                   placeholder="tag1, tag2, tag3..."
                                   value="{{ old('tags') }}" />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Separate multiple tags with commas</p>
                            @error('tags') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Scope -->
                        <div>
                            <label for="scope" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Visibility <span class="text-red-500">*</span>
                            </label>
                            <select name="scope" id="scope"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200">
                                <option value="1" @if(old('scope')==1) selected @endif>
                                    🌍 Public - Visible to everyone
                                </option>
                                <option value="2" @if(old('scope')==2) selected @endif>
                                    🔒 Private - Internal use only
                                </option>
                            </select>
                            <p class="text-xs text-orange-600 dark:text-orange-400 mt-1">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"></path>
                                </svg>
                                Private articles cannot be sent as emails
                            </p>
                            @error('scope') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200">
                                <option value="0" @if(old('status')==0) selected @endif>
                                    📝 Draft - Save for later
                                </option>
                                <option value="1" @if(old('status')==1) selected @endif>
                                    ✅ Published - Make it live
                                </option>
                            </select>
                            @error('status') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Expires -->
                        <div>
                            <label for="expires" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Expiration Date
                            </label>
                            <input type="date" name="expires" id="expires"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200"
                                   value="{{ old('expires') }}" />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Article will be archived after this date</p>
                            @error('expires') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Attachments -->
                        <div>
                            <label for="attachments" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Attachments
                            </label>
                            <div class="border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-lg p-4 hover:border-blue-400 transition-colors duration-200">
                                <input type="file" name="attachments[]" id="attachments" multiple
                                       class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300" />
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Support for multiple file uploads</p>
                            </div>
                            @error('attachments.*') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Article Body -->
                    <div class="space-y-4">
                        <label for="article_body" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Article Content <span class="text-red-500">*</span>
                        </label>
                        <div class="border border-gray-300 dark:border-zinc-600 rounded-lg overflow-hidden">
                            <textarea name="article_body" id="editor"
                                      class="w-full border-0 focus:ring-0 resize-none"
                                      placeholder="Start writing your article content here...">{{ old('article_body') }}</textarea>
                        </div>
                        @error('article_body') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-zinc-700">
                        <button type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02] shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Article
                        </button>

                        <a href="{{ route('dashboard') }}"
                           class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TinyMCE Scripts -->
    <script src="https://cdn.tiny.cloud/1/qpuriefs0vhoo7azs8ty9kf1lyz69bininv5bq6grbpqpbh7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            licence_key: 'qpuriefs0vhoo7azs8ty9kf1lyz69bininv5bq6grbpqpbh7',
            height: 600,
            selector: '#editor',
            plugins: 'template autoresize autolink image fullscreen imagetools emoticons link lists hr paste media table code',
            toolbar: 'insert undo redo fullscreen | fontsizeselect | alignleft aligncenter alignright alignjustify | h1 h2 h3 | bold italic underline strikethrough | numlist bullist | image link emoticons hr | paste table code',
            contextmenu: "link image table paste",
            content_style: `
                body {
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                    font-size: 14px;
                    line-height: 1.6;
                    color: #374151;
                    padding: 20px;
                }
                h1, h2, h3 { color: #1f2937; margin-top: 1em; margin-bottom: 0.5em; }
                p { margin-bottom: 1em; }
            `,
            templates: [
                {title: 'FAQ Template', description: 'Question and Answer format', content: '<h2>Frequently Asked Questions</h2><h3>Question 1</h3><p>Answer to question 1...</p>'},
                {title: 'Step by Step Guide', description: 'Numbered steps template', content: '<h2>Step by Step Guide</h2><ol><li>First step</li><li>Second step</li><li>Third step</li></ol>'},
                {title: 'Troubleshooting Template', description: 'Problem solving format', content: '<h2>Troubleshooting</h2><h3>Problem</h3><p>Description of the problem...</p><h3>Solution</h3><p>Steps to resolve...</p>'}
            ],
            autoresize_bottom_margin: 50,
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route("image.upload") }}');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
        });
    </script>
</x-layouts.app>
