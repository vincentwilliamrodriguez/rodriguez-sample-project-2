<div>
    @if ($showModal)
        <x-dialog-modal>
            <x-slot name="title">
                Create Task
            </x-slot>

            <x-slot name="content">
                <div class="max-w-full w-full">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <x-label for="name" value="Name" />
                            <x-input id="name" type="text" class="w-full rounded-md block"
                                        wire:model="item.name" />
                            @error('item.name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12">
                            <x-label for="description" value="Description" />
                            <x-input id="description" type="text" class="w-full rounded-md block"
                                        wire:model="item.description" />
                            @error('item.description') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6">
                            <x-label for="status" value="Status" />
                            <select name="status" id="status" wire:model="item.status" class="w-full rounded-md block">
                                <option value="" selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Complete">Complete</option>
                            </select>
                            @error('item.status') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-6">
                            <x-label for="due_date" value="Due Date" />
                            <x-input id="due_date" type="date" class="w-full rounded-md block"
                                wire:model="item.due_date" />
                            @error('item.due_date') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click.prevent="$set('showModal', false)" mode="cancel" class="mx-4">Cancel</x-button>
                <x-button wire:click="saveTask" mode="confirm" wire:loading.attr="disabled">Add</x-button>
            </x-slot>

        </x-dialog-modal>
    @endif
</div>
