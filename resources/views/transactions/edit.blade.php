<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cashier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Search Produk -->
                    <div class="mb-4">
                        <input type="text" id="search-product" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                               placeholder="Search product...">
                    </div>

                    <!-- Daftar Produk -->
                    <div id="product-list" class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Produk akan ditampilkan di sini menggunakan AJAX -->
                    </div>

                    <!-- Keranjang -->
                    <h4 class="font-semibold mb-2">Cart</h4>
                    <table class="min-w-full border-collapse border border-gray-300" id="cart-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Product</th>
                                <th class="px-4 py-2 border">Qty</th>
                                <th class="px-4 py-2 border">Price</th>
                                <th class="px-4 py-2 border">Total</th>
                                <th class="px-4 py-2 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Items in cart will be dynamically added here -->
                        </tbody>
                    </table>

                    <!-- Total Bayar -->
                    <div class="mt-4">
                        <h4 class="font-semibold">Total: <span id="total-price">0</span></h4>
                    </div>

                    <!-- Pembayaran -->
                    <div class="mt-4">
                        <label for="payment" class="block text-sm font-medium text-gray-700">Cash Received</label>
                        <input type="number" id="payment" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                               placeholder="Enter amount received" oninput="calculateChange()">
                    </div>

                    <!-- Kembalian -->
                    <div class="mt-4">
                        <h4 class="font-semibold">Change: <span id="change">0</span></h4>
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <button id="submit-transaction" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                            Submit Transaction
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let cart = @json($cart);
        let totalPrice = cart.reduce((sum, item) => sum + item.qty * item.price, 0);
        const transactionId = {{ $transaction->id }};

        $(document).ready(function () {
            updateCartTable();
        });

        function addToCart(productId, name, price, stock) {
            let existingItem = cart.find(item => item.productId === productId);
            if (existingItem) {
                if (existingItem.qty < stock) {
                    existingItem.qty++;
                } else {
                    alert('Jumlah melebihi stok!');
                    existingItem.qty = stock;
                }
            } else {
                cart.push({ productId, name, price, qty: 1, stock: stock });
            }
            updateCartTable();
        }

        function updateQuantity(productId, qty) {
            const product = cart.find(item => item.productId === productId);
            if (product) {
                qty = parseInt(qty, 10);
                if (isNaN(qty) || qty < 1) {
                    alert('Jumlah Tidak Boleh 0');
                    qty = 1;
                } else if (qty > product.stock) {
                    alert('Jumlah melebihi stok!');
                    qty = product.stock;
                }
                product.qty = qty;
                product.total = product.qty * product.price;
                updateCartTable();
            }
        }

        function removeItemFromCart(productId) {
            cart = cart.filter(item => item.productId !== productId);
            updateCartTable();
        }

        function updateCartTable() {
            $('#cart-table tbody').empty();
            totalPrice = 0;

            cart.forEach(item => {
                let totalItemPrice = item.qty * item.price;
                totalPrice += totalItemPrice;

                $('#cart-table tbody').append(`
                    <tr class="border">
                        <td class="px-4 py-2 border">${item.name}</td>
                        <td class="px-4 py-2 border">
                            <input type="number" min="1" max="${item.stock}" value="${item.qty}" onchange="updateQuantity(${item.productId}, this.value)" class="border rounded-md">
                        </td>
                        <td class="px-4 py-2 border">${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.price)}</td>
                        <td class="px-4 py-2 border">${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalItemPrice)}</td>
                        <td class="px-4 py-2 border">
                            <button onclick="removeItemFromCart(${item.productId})" class="text-red-500">Remove</button>
                        </td>
                    </tr>
                `);
            });

            $('#total-price').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalPrice));
            calculateChange();
        }

        function calculateChange() {
            let payment = parseInt(document.getElementById('payment').value) || 0;
            let change = payment - totalPrice;

            document.getElementById('change').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(change);

            let submitButton = document.getElementById('submit-transaction');
            if (payment < totalPrice) {
                submitButton.disabled = true;
                submitButton.classList.add('bg-gray-500', 'cursor-not-allowed');
                submitButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            } else {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-500', 'cursor-not-allowed');
                submitButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
            }
        }

        $('#submit-transaction').on('click', function () {
            if (cart.length === 0) {
                alert('Keranjang kosong, tambahkan produk terlebih dahulu.');
                return;
            }

            const payment = parseInt($('#payment').val());
            const change = payment - totalPrice;

            if (payment < totalPrice) {
                alert('Uang yang diterima kurang dari total harga.');
                return;
            }

            const transactionData = {
                total_price: totalPrice,
                date: new Date().toISOString().split('T')[0],
                cart: cart.map(item => ({
                    productId: item.productId,
                    qty: item.qty,
                    price: item.price,
                })),
            };

            $.ajax({
                url: `/transactions/${transactionId}`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: {
                    ...transactionData,
                    _method: 'PATCH',
                },
                success: function (response) {
                    alert('Transaksi berhasil disimpan!');
                    location.reload();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Gagal menyimpan transaksi.');
                },
            });


        });


    </script>
</x-app-layout>
