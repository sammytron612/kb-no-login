<!-- filepath: c:\Users\Kevin\kb-new\resources\views\admin\settings.blade.php -->
<x-layouts.app.main>
<div class="container mx-auto py-8 px-8">
    <!-- Header Section with Icon -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
            <flux:icon.cog-6-tooth class="w-8 h-8 text-gray-600 dark:text-gray-400" />
        </div>

        <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 dark:text-white mb-3">Settings</h1>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Configure your knowledge base system settings</p>
    </div>
    <!-- ADD THIS: Success/Error Messages -->
    <div x-data="{ show: false, message: '', type: 'success' }"
        @setting-updated.window="show = true; message = $event.detail[0].message; type = $event.detail[0].type; setTimeout(() => show = false, 5000)">
        <div x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            :class="type === 'success' ? 'bg-green-100 dark:bg-green-900 border-green-400 text-green-700 dark:text-green-200' : 'bg-red-100 dark:bg-red-900 border-red-400 text-red-700 dark:text-red-200'"
            class="mb-6 border px-4 py-3 rounded-lg">
            <span x-text="message"></span>
        </div>
    </div>



    <!-- Settings Form -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700">

            <!-- Invites Setting -->
            <div class="border-b border-gray-200 dark:border-zinc-700 p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Registration Control</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                            Control how users can register for your knowledge base system.
                        </p>

                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                            <div class="flex items-start">
                                <flux:icon.information-circle class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" />
                                <div class="text-sm text-blue-800 dark:text-blue-200">
                                    <strong>Enabled:</strong> Only users with invitation links can register<br>
                                    <strong>Disabled:</strong> Anyone can register without an invitation
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="ml-6">
                        <livewire:admin.invite-toggle />
                    </div>
                </div>
            </div>

            <!-- Full Text Search Setting -->
            <div class="border-b border-gray-200 dark:border-zinc-700 p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Full Text Search</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                            Enable advanced full-text search capabilities for better content discovery.
                        </p>

                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                            <div class="flex items-start">
                                <flux:icon.magnifying-glass class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3 flex-shrink-0" />
                                <div class="text-sm text-yellow-800 dark:text-yellow-200">
                                    <strong>Enabled:</strong> Advanced search with better relevance and faster results<br>
                                    <strong>Disabled:</strong> Basic search functionality only
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ml-6">
                        <livewire:admin.full-text-toggle />
                    </div>
                </div>
            </div>

            <!-- Editor Permissions Setting -->
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Editor Permissions</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                            Allow editors to delete their own articles without admin approval.
                        </p>

                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                            <div class="flex items-start">
                                <flux:icon.trash class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5 mr-3 flex-shrink-0" />
                                <div class="text-sm text-red-800 dark:text-red-200">
                                    <strong>Enabled:</strong> Editors can delete their own articles<br>
                                    <strong>Disabled:</strong> Only admins can delete articles
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ml-6">
                        <livewire:admin.editor-permissions-toggle />
                    </div>
                </div>
            </div>

    </div>
</div>
</x-layouts.app.main>
