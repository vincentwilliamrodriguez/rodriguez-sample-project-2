<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
                    <p class="mt-1 text-gray-600">{{ $user->description }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                    <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($user->due_date)->format('F j, Y') }}</p>
                    <p><strong>Completion Date:</strong>
                        {{ $user->completion_date ? \Carbon\Carbon::parse($user->completion_date)->format('F j, Y') : 'N/A' }}
                    </p>
                </div>

                <div class="mt-6 flex space-x-3">
                    <a href="{{ route('users.edit', $user) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Edit
                    </a>
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
