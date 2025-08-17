<x-layouts.app>
<div class="container mx-auto py-8 px-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-600">Admin Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('admin.invites') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center hover:shadow-xl transition group" wire:navigate>
            <div class="bg-blue-100 rounded-full p-3 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12v1a4 4 0 01-8 0v-1m8 0V9a4 4 0 00-8 0v3m8 0a4 4 0 01-8 0" /></svg>
            </div>

            <span class="text-gray-600 dark:text-gray-300 mt-2 group-hover:text-blue-600">Invites</span>
        </a>
        <a href="{{ route('admin.users') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center hover:shadow-xl transition group" wire:navigate>
            <div class="bg-green-100 rounded-full p-3 mb-2">
                <flux:icon.user />
            </div>

            <span class="text-gray-600 dark:text-gray-300 mt-2 group-hover:text-green-600">Users</span>
        </a>
        <a href="{{ route('admin.approvals') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center hover:shadow-xl transition group" wire:navigate>
            <div class="bg-yellow-100 rounded-full p-3 mb-2">
                <flux:icon.hand-thumb-up />
            </div>

            <span class="text-gray-600 dark:text-gray-300 mt-2 group-hover:text-yellow-600">Approvals</span>
        </a>
        <a href="{{ route('admin.settings') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow p-6 flex flex-col items-center hover:shadow-xl transition group" wire:navigate>
            <div class="bg-red-100 rounded-full p-3 mb-2">
                <flux:icon.adjustments-horizontal />
            </div>

            <span class="text-gray-600 dark:text-gray-300 mt-2 group-hover:text-red-600">Settings</span>
        </a>
    </div>
</div>
</x-layouts.app>
