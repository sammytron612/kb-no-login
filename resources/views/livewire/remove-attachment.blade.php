<div>
    <button type="button" wire:click="removeAttachment()" class="ml-2 p-1 hover:cursor-pointer bg-red-600 text-white rounded shadow hover:bg-red-700 transition flex items-center gap-2">
        <flux:icon.trash variant="micro"/>
    </button>
    @script
<script>
    $wire.on('attachmentRemoved', (event) => {
        index = event[0].attachmentIndex;
        const element = document.getElementById("attachment-" + index);
        element.remove();
    });
</script>
@endscript
</div>
