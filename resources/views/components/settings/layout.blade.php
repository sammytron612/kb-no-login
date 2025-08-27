<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage your account preferences and settings</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Navigation -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Account Settings
                        </h3>
                    </div>
                    <nav class="p-3">
                        <div class="space-y-1">
                            <a href="{{ route('settings.profile') }}"
                               wire:navigate
                               class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.profile') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 shadow-sm' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('settings.profile') ? 'bg-blue-100 dark:bg-blue-800' : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-gray-200 dark:group-hover:bg-gray-600' }} mr-3">
                                    <svg class="w-4 h-4 {{ request()->routeIs('settings.profile') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span>Profile</span>
                                @if(request()->routeIs('settings.profile'))
                                    <div class="ml-auto">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    </div>
                                @endif
                            </a>

                            <a href="{{ route('settings.password') }}"
                               wire:navigate
                               class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.password') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 shadow-sm' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('settings.password') ? 'bg-blue-100 dark:bg-blue-800' : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-gray-200 dark:group-hover:bg-gray-600' }} mr-3">
                                    <svg class="w-4 h-4 {{ request()->routeIs('settings.password') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <span>Password</span>
                                @if(request()->routeIs('settings.password'))
                                    <div class="ml-auto">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    </div>
                                @endif
                            </a>

                            <a href="{{ route('settings.appearance') }}"
                               wire:navigate
                               class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.appearance') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 shadow-sm' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('settings.appearance') ? 'bg-blue-100 dark:bg-blue-800' : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-gray-200 dark:group-hover:bg-gray-600' }} mr-3">
                                    <svg class="w-4 h-4 {{ request()->routeIs('settings.appearance') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                </div>
                                <span>Appearance</span>
                                @if(request()->routeIs('settings.appearance'))
                                    <div class="ml-auto">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    </div>
                                @endif
                            </a>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 min-w-0">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <!-- Content Header -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <flux:heading class="text-xl font-semibold text-gray-900 dark:text-white">{{ $heading ?? '' }}</flux:heading>
                        @if($subheading ?? false)
                            <flux:subheading class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $subheading }}</flux:subheading>
                        @endif
                    </div>

                    <!-- Content Body -->
                    <div class="p-6">
                        <div class="max-w-2xl">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
