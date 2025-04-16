<div class="p-4">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Task Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <div class="mb-2">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search tasks..."
                        class="border rounded px-4 py-2"
                    />
                </div>
                <div class="mx-2">
                    <x-button wire:click.prevent="$dispatchTo('task-child', 'showAdd')" mode="confirm" class="ml-2">
                        + Create Task
                    </x-button>
                    @livewire('task-child')
                    {{-- <a href="#"
                   class="inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    + Create Task
                    </a> --}}
                </div>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 cursor-pointer"
                                wire:click="sortBy('name')">
                                Task Name
                                @if ($sortColumn === 'name')
                                    @if ($sortOrder === 'asc')
                                        <i class="fas fa-sort-up"></i>
                                    @else
                                        <i class="fas fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort"></i>
                                @endif
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 cursor-pointer"
                                wire:click="sortBy('status')">
                                Status
                                @if ($sortColumn === 'status')
                                    @if ($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort"></i>
                                @endif
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 cursor-pointer"
                                wire:click="sortBy('due_date')">
                                Due Date
                                @if ($sortColumn === 'due_date')
                                    @if ($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort"></i>
                                @endif
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tasks as $task)
                            <tr>
                                <td class="px-6 py-4">{{ $task->name }}</td>
                                <td class="px-6 py-4 capitalize">{{ $task->status }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($task->due_date)->toDateString() }}</td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="$dispatchTo('task-child', 'showEdit', { id: {{ $task->id }} });" class="text-blue-400">Edit</button>
                                    <button wire:click="$dispatchTo('task-child', 'showDel', { id: {{ $task->id }} });" class="text-red-400">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No tasks found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
