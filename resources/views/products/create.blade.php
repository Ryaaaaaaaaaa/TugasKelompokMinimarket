<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Create a New Product</h3>
                    <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Product Price</label>
                            <input type="number" name="price" id="price" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Product Stock</label>
                            <input type="number" name="stock" id="stock" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('products.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 mr-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>