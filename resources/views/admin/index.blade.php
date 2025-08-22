<!-- filepath: c:\Users\Kevin\kb-new\resources\views\admin\index.blade.php -->
<x-layouts.app :title="__('Admin Dashboard')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-zinc-900 dark:via-slate-900 dark:to-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header Section -->
            <div class="text-center mb-12 relative">
                <!-- Background decoration -->
                <div class="absolute inset-0 flex items-center justify-center opacity-5 dark:opacity-10">
                    <svg class="w-96 h-96 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full shadow-lg mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                        Admin Dashboard
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Manage your Knowledge Base with powerful administrative tools
                    </p>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
                <!-- Total Users -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-6 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\User::count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Users</div>
                            </div>
                        </div>
                        <div class="flex items-center text-sm">
                            <span class="text-green-600 dark:text-green-400 font-medium">
                                +{{ \App\Models\User::where('created_at', '>=', now()->subMonth())->count() }}
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 ml-1">this month</span>
                        </div>
                    </div>
                </div>

                <!-- Total Articles -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-6 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Article::count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Articles</div>
                            </div>
                        </div>
                        <div class="flex items-center text-sm">
                            <span class="text-green-600 dark:text-green-400 font-medium">
                                +{{ \App\Models\Article::where('created_at', '>=', now()->subMonth())->count() }}
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 ml-1">this month</span>
                        </div>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600/20 to-red-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-6 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Article::where('approved', 0)->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Pending Approval</div>
                            </div>
                        </div>
                        <div class="flex items-center text-sm">
                            @if(\App\Models\Article::where('approved', 0)->count() > 0)
                                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse mr-2"></div>
                                <span class="text-red-600 dark:text-red-400 font-medium">Action required</span>
                            @else
                                <span class="text-green-600 dark:text-green-400 font-medium">All caught up!</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Active Invitations -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-emerald-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-6 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ \App\Models\Invitation::where('expires_at', '>', now())->whereNull('accepted_at')->count() }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Active Invites</div>
                            </div>
                        </div>
                        <div class="flex items-center text-sm">
                            <span class="text-blue-600 dark:text-blue-400 font-medium">
                                {{ \App\Models\Invitation::whereNotNull('accepted_at')->count() }} accepted
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Admin Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-12">
                <!-- Invites -->
                <a href="{{ route('admin.invites') }}"
                   class="group relative block"
                   wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-8 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-indigo-600 transition-all duration-300">
                            Send Invitations
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4">
                            Invite new users to join the Knowledge Base with secure registration links
                        </p>
                        <div class="flex items-center justify-center text-sm text-blue-600 dark:text-blue-400 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Manage Invites
                        </div>
                    </div>
                </a>

                <!-- Users -->
                <a href="{{ route('admin.users') }}"
                   class="group relative block"
                   wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-emerald-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-8 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-green-600 group-hover:to-emerald-600 transition-all duration-300">
                            User Management
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4">
                            View and manage user accounts, permissions, and activity across the platform
                        </p>
                        <div class="flex items-center justify-center text-sm text-green-600 dark:text-green-400 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Manage Users
                        </div>
                    </div>
                </a>

                <!-- Approvals -->
                <a href="{{ route('admin.approvals') }}"
                   class="group relative block"
                   wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600/20 to-red-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-8 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 relative">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @if(\App\Models\Article::where('approved', 0)->count() > 0)
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">{{ \App\Models\Article::where('approved', 0)->count() }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-orange-600 group-hover:to-red-600 transition-all duration-300">
                            Article Approvals
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4">
                            Review and approve pending articles to maintain high content quality standards
                        </p>
                        <div class="flex items-center justify-center text-sm text-orange-600 dark:text-orange-400 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Review Articles
                        </div>
                    </div>
                </a>

                <!-- Settings -->
                <a href="{{ route('admin.settings') }}"
                   class="group relative block"
                   wire:navigate>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-8 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-purple-600 group-hover:to-pink-600 transition-all duration-300">
                            System Settings
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4">
                            Configure platform settings, notifications, and system-wide preferences
                        </p>
                        <div class="flex items-center justify-center text-sm text-purple-600 dark:text-purple-400 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Configure System
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white/90 dark:bg-zinc-800/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 dark:border-zinc-700/50 p-8 relative overflow-hidden">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-5 dark:opacity-10">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20"></div>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">System Overview</h2>
                                <p class="text-gray-600 dark:text-gray-400">Recent activity and platform health</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <div class="text-sm text-gray-600 dark:text-gray-400">Last updated</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ now()->format('g:i A') }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Recent Users -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6 border border-blue-100 dark:border-blue-800/50">
                            <h4 class="text-lg font-semibold text-blue-900 dark:text-blue-300 mb-4">New Users</h4>
                            <div class="space-y-3">
                                @forelse(\App\Models\User::latest()->take(3)->get() as $user)
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-semibold text-white">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-blue-900 dark:text-blue-300 truncate">{{ $user->name }}</p>
                                            <p class="text-xs text-blue-600 dark:text-blue-400">{{ $user->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-blue-600 dark:text-blue-400">No recent users</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Recent Articles -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 border border-green-100 dark:border-green-800/50">
                            <h4 class="text-lg font-semibold text-green-900 dark:text-green-300 mb-4">Recent Articles</h4>
                            <div class="space-y-3">
                                @forelse(\App\Models\Article::latest()->take(3)->get() as $article)
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mt-0.5">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-green-900 dark:text-green-300 truncate">{{ $article->title }}</p>
                                            <p class="text-xs text-green-600 dark:text-green-400">{{ $article->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-green-600 dark:text-green-400">No articles yet</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- System Health -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-2xl p-6 border border-purple-100 dark:border-purple-800/50">
                            <h4 class="text-lg font-semibold text-purple-900 dark:text-purple-300 mb-4">System Health</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-purple-700 dark:text-purple-300">Database</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="text-xs font-medium text-green-600">Online</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-purple-700 dark:text-purple-300">Cache</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="text-xs font-medium text-green-600">Active</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-purple-700 dark:text-purple-300">Storage</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="text-xs font-medium text-green-600">Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>