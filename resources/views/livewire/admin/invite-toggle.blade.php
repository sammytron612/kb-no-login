<!-- filepath: c:\Users\Kevin\kb-new\resources\views\livewire\admin\invite-toggle.blade.php -->
<?php

use Livewire\Volt\Component;
use App\Models\Setting;

new class extends Component {
    public $invites = false;

    public function mount()
    {
        $settings = Setting::getInstance(); // Changed from Setting::first()
        $this->invites = $settings->invites;
    }

    public function updatedInvites() // This runs when wire:model changes the value
    {
        Setting::set('invites', $this->invites);

        $message = $this->invites
            ? 'Invite-only registration enabled. Only users with invitation links can register.'
            : 'Open registration enabled. Anyone can register without an invitation.';

        $this->dispatch('setting-updated', [
            'message' => $message,
            'type' => 'success'
        ]);
    }
}; ?>

<div>
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox"
               wire:model.live="invites"
               class="sr-only peer">
        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
            {{ $invites ? 'Enabled' : 'Disabled' }}
        </span>
    </label>
</div>
