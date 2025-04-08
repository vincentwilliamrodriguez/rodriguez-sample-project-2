<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- User Name -->
                    <div class="flex flex-col">
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col">
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col">
                        <input type="password" name="password" placeholder="Enter password" value="{{ old('password') }}">
                        @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Role selection -->
                    <div class="mt-4">
                        <label for="roles" class="block text-sm">Roles:</label>
                        <select name="roles[]" id="roles" class="form-select block mt-1" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('roles[]') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
