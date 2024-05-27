<div>
    <x-mary-modal wire:model="modal" class="backdrop-blur">
        <div class="mb-5">Press `ESC`, click outside or click `CANCEL` to close.</div>
        <x-mary-button label="Cancel" @click="$wire.modal = false" />
    </x-mary-modal>
     
    <x-mary-button label="Open" @click="$wire.modal = true" /> 
</div>
