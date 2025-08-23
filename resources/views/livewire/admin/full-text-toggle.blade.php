<!-- filepath: c:\Users\Kevin\kb-new\resources\views\livewire\admin\fulltext-toggle.blade.php -->
<?php

use Livewire\Volt\Component;
use App\Models\Setting;

new class extends Component {
    public $full_text = false;

    public function mount()
    {
        $settings = Setting::first();
        $this->full_text = $settings->full_text;
    }

    public function updatedFullText() // This runs when wire:model changes the value
    {
        Setting::set('full_text', $this->full_text);

        $message = $this->full_text
            ? 'Full text search enabled. Advanced search with better relevance and faster results.'
            : 'Full text search disabled. Basic search functionality only.';

        $this->dispatch('setting-updated', [
            'message' => $message,
            'type' => 'success'
        ]);
    }
}; ?>

<div>
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox"
               wire:model.live="full_text"
               class="sr-only peer">
        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
            {{ $full_text ? 'Enabled' : 'Disabled' }}
        </span>
    </label>
</div>
