<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Task Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(session('message'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                    {{ session('message') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('tasks.create') }}"
                   class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    + Create Task
                </a>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Task Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Due Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Completion Date
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
                                <td class="px-6 py-4">
                                    @if ($task->completion_date)
                                        {{ \Carbon\Carbon::parse($task->completion_date)->toDateString() }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('tasks.show', $task) }}"
                                       class="inline-flex items-center rounded bg-blue-400 px-3 py-1 text-sm text-white hover:bg-blue-500">
                                        View
                                    </a>
                                    <a href="{{ route('tasks.edit', $task) }}"
                                       class="inline-flex items-center rounded bg-yellow-400 px-3 py-1 text-sm text-white hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure?')"
                                                class="inline-flex items-center rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
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
</x-app-layout>
