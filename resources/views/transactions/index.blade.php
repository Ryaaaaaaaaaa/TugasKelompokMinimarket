<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">List of Transactions</h3>
                        <a href="{{ route('transactions.create') }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                            Tambah
                        </a>
                    </div>

                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Cashier</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Price</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Date</th>
                                <th class="border border-gray-200 px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $transaction->user->name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $transaction->total_price }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $transaction->date }}</td>
                                    <td class="border border-gray-200 px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('transactions.detail', $transaction->id) }}"
                                                class="px-3 py-1 text-sm font-medium text-white bg-orange-400 rounded-lg shadow hover:bg-green-600">
                                                Detail
                                            </a>
                                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                class="px-3 py-1 text-sm font-medium text-white bg-green-500 rounded-lg shadow hover:bg-green-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="delete-form">
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
                                        No transaction found.
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
                    const confirmation = confirm('Apa Kamu Yakin delete transaction ini?');
                    if (confirmation) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
