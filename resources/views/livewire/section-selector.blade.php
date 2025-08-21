<div class="relative" x-data="{ open: @entangle('isOpen') }" @click.away="$wire.closeDropdown()">
    <!-- Hidden input for form submission -->
    <input type="hidden" name="{{ $name }}" value="{{ $selectedSection }}" />

    <!-- Search Input -->
    <div class="relative">
        <input
            type="text"
            wire:model.live="search"
            wire:focus="openDropdown"
            @keydown.arrow-down.prevent="$wire.handleKeydown('ArrowDown')"
            @keydown.arrow-up.prevent="$wire.handleKeydown('ArrowUp')"
            @keydown.enter.prevent="$wire.handleKeydown('Enter')"
            @keydown.escape="$wire.handleKeydown('Escape')"
            class="w-full px-4 py-3 pr-10 border border-gray-300 dark:border-zinc-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-700 dark:text-white transition-all duration-200"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
        />

        <!-- Dropdown Arrow -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            @if($selectedSection)
                <button
                    type="button"
                    wire:click="clearSelection"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            @endif
            <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                 :class="{ 'transform rotate-180': open }"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>

    <!-- Error Message -->
    @error($name)
        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
    @enderror

    <!-- Dropdown Menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 w-full mt-1 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-lg max-h-60 overflow-y-auto"
        style="display: none;"
    >
        @if($filteredSections && $filteredSections->count() > 0)
            @foreach($filteredSections as $index => $section)
                <div
                    wire:click="selectSection({{ $section->id }})"
                    class="px-4 py-3 cursor-pointer transition-colors duration-150 flex items-center
                           {{ $highlightedIndex === $index ? 'bg-blue-100 dark:bg-blue-900/50' : 'hover:bg-gray-100 dark:hover:bg-zinc-700' }}
                           {{ $selectedSection == $section->id ? 'bg-blue-50 dark:bg-blue-900/25 text-blue-700 dark:text-blue-300' : 'text-gray-900 dark:text-gray-100' }}"
                    style="font-family: 'SF Mono', 'Monaco', 'Consolas', monospace; font-size: 13px;"
                >
                    <!-- Hierarchy indicator -->
                    <span class="text-gray-500 dark:text-gray-400 mr-2 whitespace-pre">{{ $section->indent }}</span>

                    <!-- Icon -->
                    <span class="mr-2">{{ $section->icon }}</span>

                    <!-- Section name -->
                    <span class="flex-1 truncate">{{ $section->section }}</span>

                    <!-- Selected indicator -->
                    @if($selectedSection == $section->id)
                        <svg class="w-4 h-4 ml-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @endif
                </div>
            @endforeach
        @else
            <div class="px-4 py-3 text-gray-500 dark:text-gray-400 text-center">
                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                @if(empty($search))
                    No sections available
                @else
                    No sections found for "{{ $search }}"
                @endif
            </div>
        @endif
    </div>

    <!-- Helper text -->
    @if(!$selectedSection)
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center">
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path>
            </svg>
            Type to search or click to browse sections
        </p>
    @else
        <p class="text-xs text-green-600 dark:text-green-400 mt-1 flex items-center">
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
            </svg>
            Selected: {{ $this->selectedSectionName }}
        </p>
    @endif
</div>
