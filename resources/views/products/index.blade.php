<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">List of Products</h3>
                        <a href="{{ route('products.create') }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                            Tambah
                        </a>
                    </div>

                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Name</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Price</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Stock</th>
                                <th class="border border-gray-200 px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $product->name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $product->stock }}</td>
                                    <td class="border border-gray-200 px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="px-3 py-1 text-sm font-medium text-white bg-green-500 rounded-lg shadow hover:bg-green-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-lg shadow hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-200 px-4 py-2 text-center">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const confirmation = confirm('Apa Kamu Yakin delete product ini?');
                    if (confirmation) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
