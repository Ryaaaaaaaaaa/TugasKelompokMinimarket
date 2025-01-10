<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <div class="card-body">
                            <h4 class="text-lg font-semibold">Informasi Transaksi</h4>
                            <div class="mb-4">
                                <p><strong>Number Transaksi:</strong> {{ $transaction->transaction_number }}</p>
                                <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d-m-Y H:i') }}</p>
                                <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            </div>
                            <h4 class="text-lg font-semibold">Detail Barang</h4>
                            <table class="min-w-full border-collapse border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-200 px-4 py-2 text-left">No</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Kode Barang</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Nama Barang</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Harga</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Jumlah</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transaction->transactionDetails as $index => $detail)
                                        <tr>
                                            <td class="border border-gray-200 px-4 py-2">{{ $index + 1 }}</td>
                                            <td class="border border-gray-200 px-4 py-2">{{ strtoupper($detail->product->code) }}</td>
                                            <td class="border border-gray-200 px-4 py-2">{{ $detail->product->name }}</td>
                                            <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                                            <td class="border border-gray-200 px-4 py-2">{{ $detail->qty }}</td>
                                            <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($detail->unit_price * $detail->qty, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-gray-500">Tidak ada barang dalam transaksi ini</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

