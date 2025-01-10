<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Branch') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Update Branch</h3>
                    <form action="{{ route('branches.update', $branch->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Branch Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $branch->name) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Branch Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $branch->location) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('branches.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 mr-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
