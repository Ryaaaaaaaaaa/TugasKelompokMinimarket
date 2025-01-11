<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-600 text-white py-6 px-4">
            <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="text-lg mt-2">Kelola transaksi dan stok barang dengan mudah</p>
        </div>
    </x-slot>

    <div class="bg-gray-100 min-h-screen">
        <!-- Navigasi -->
        <div class="bg-white shadow-md py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex justify-between">
                    <a href="#" class="text-blue-600 font-medium hover:underline">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Transaksi</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Stok Barang</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Laporan</a>
                </nav>
            </div>
        </div>

        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-gray-600 font-medium">Total Transaksi</h4>
                    <p class="text-3xl font-bold text-gray-800 mt-2">Rp 15,000,000</p>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="w-3/4 h-full bg-blue-500"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">75% dari target</p>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-gray-600 font-medium">Produk Terjual</h4>
                    <p class="text-3xl font-bold text-gray-800 mt-2">1,500 Unit</p>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="w-2/3 h-full bg-green-500"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">65% dari target</p>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-gray-600 font-medium">Stok Barang</h4>
                    <p class="text-3xl font-bold text-gray-800 mt-2">7,800 Unit</p>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="w-4/5 h-full bg-purple-500"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">80% tersisa</p>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-gray-600 font-medium">Cabang Aktif</h4>
                    <p class="text-3xl font-bold text-gray-800 mt-2">5 Cabang</p>
                    <div class="mt-4">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="w-full h-full bg-red-500"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">100% dioperasikan</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                <ul>
                    <li class="flex justify-between items-center py-2 border-b">
                        <p class="text-gray-600">Transaksi #12345 berhasil diproses</p>
                        <span class="text-sm text-gray-500">5 menit lalu</span>
                    </li>
                    <li class="flex justify-between items-center py-2 border-b">
                        <p class="text-gray-600">Stok barang di Gudang Jakarta diperbarui</p>
                        <span class="text-sm text-gray-500">10 menit lalu</span>
                    </li>
                    <li class="flex justify-between items-center py-2 border-b">
                        <p class="text-gray-600">Manajer Toko Surabaya mencetak laporan</p>
                        <span class="text-sm text-gray-500">1 jam lalu</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
