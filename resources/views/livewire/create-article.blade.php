<div>
    <form wire:submit.prevent="submit" class="space-y-6">
        @if (session()->has('success'))
            <div class="p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <flux:input type="text" wire:model="title" label="Title" class="focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" />
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <flux:input type="text" wire:model="tags" label="Tags"
                    placeholder="Comma separated" class="focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" />
                @error('tags') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="section" class="block font-medium">Section</label>
                <input type="text" id="section" wire:model.defer="section" class="w-full border rounded p-2" required />
                @error('section') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="attachments" class="block font-medium">Attachments</label>
                <input type="file" id="attachments" wire:model="attachments" multiple class="w-full border rounded p-2" />
                @error('attachments.*') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <flux:select wire:model="scope" placeholder="" label="Scope" class="focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <flux:select.option value="1">Public</flux:select.option>
                    <flux:select.option value="2">Private</flux:select.option>
                </flux:select>
                @error('scope') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <flux:select wire:model="status" label="Status" class="focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <flux:select.option value="1">Publish</flux:select.option>
                    <flux:select.option value="0">Draft</flux:select.option>
                </flux:select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="expires" class="block font-medium">Expires</label>
                <input class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-gray-700 dark:text-gray-200 dark:bg-gray-800 dark:border-gray-600"
                     type="date" wire:model='expires' />
                @error('expires') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="body" class="block font-medium">Body</label>
            <textarea id="body" wire:model.defer="body" class="w-full border rounded p-2 h-32" required></textarea>
            @error('body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded">Create Article</button>
    </form>
</div>
