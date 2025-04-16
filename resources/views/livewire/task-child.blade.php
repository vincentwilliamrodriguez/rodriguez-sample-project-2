<div>
    @if ($showModal)
        <x-dialog-modal>
            <x-slot name="title">
                {{($isEditMode) ? 'Edit Task' : 'Create Task'}}
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
                            <select name="status" id="status" wire:model.live="item.status" class="w-full rounded-md block">
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

                        @if ($isEditMode && $isComplete)
                            <div class="col-span-6">
                                <x-label for="due_date" value="Completion Date" />
                                <x-input id="due_date" type="date" class="w-full rounded-md block"
                                    wire:model="item.due_date" />
                            </div>
                        @endif
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click.prevent="$set('showModal', false)" mode="cancel" class="mx-4">Cancel</x-button>
                <x-button wire:click="saveTask" mode="confirm" wire:loading.attr="disabled">{{ $isEditMode ? 'Update' : 'Add'}}</x-button>
            </x-slot>

        </x-dialog-modal>
    @endif


    @if ($showDel)
        <x-dialog-modal>
            <x-slot name="title">Delete Record</x-slot>

            <x-slot name="content">
                <div class="max-w-full w-full">
                    <p class="text-center">Are you sure you want to delete this record?</p>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click.prevent="$set('showDel', false)" mode="cancel" class="mx-4">Cancel</x-button>
                <x-button wire:click="deleteTask" mode="confirm" wire:loading.attr="disabled">Delete</x-button>
            </x-slot>

        </x-dialog-modal>
    @endif
</div>
