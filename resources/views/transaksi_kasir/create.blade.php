<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi Kasir</title>
    <!-- CSS dan JS yang diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/background.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3">SembakoQu</a>
        <div class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
            <span class="mr-4">Hello, {{ Auth::user()->name }}!</span>
        </div>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <span class="mr-4">Hello, {{ Auth::user()->name }}!</span>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-black py-2 px-4 rounded">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <div class="container mt-5">
                <div class="custom-bg">
                    <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">Tambah Transaksi Penjualan</h1>
                    <form id="transactionForm" action="{{ route('transaksi_kasir.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kasir_id">Kasir:</label>
                            <div class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                <span class="mr-4">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="produk" class="block text-gray-700 text-sm font-bold mb-2">Produk:</label>
                            <div id="produkContainer">
                                <div class="flex mb-2 items-center">
                                    <select name="produk[0][produk_id]"
                                        class="produk-select shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                                        @foreach ($produkList as $produk)
                                            <option value="{{ $produk['id'] }}" data-harga="{{ $produk['harga_jual'] }}">{{ $produk['id'] }} - {{ $produk['name'] }} - Rp {{ number_format($produk['harga_jual'], 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="produk[0][quantity]" placeholder="Quantity"
                                        class="quantity-input shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        oninput="calculateTotal()">
                                    <span class="total-harga-per-produk w-1/4 text-gray-700"></span>
                                    <button type="button" onclick="removeProduct(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" onclick="addProduct()">Add Product</button>
                            @error('produk')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="totalHarga" class="block text-gray-700 text-sm font-bold mb-2">Total Harga:</label>
                            <input type="text" id="totalHarga" name="totalHarga" readonly
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addProduct() {
            const produkContainer = document.getElementById('produkContainer');
            const produkIndex = produkContainer.children.length;
            const div = document.createElement('div');
            div.className = 'flex mb-2 items-center';
            div.innerHTML = `
                <select name="produk[${produkIndex}][produk_id]" class="produk-select shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                    @foreach ($produkList as $produk)
                        <option value="{{ $produk['id'] }}" data-harga="{{ $produk['harga_jual'] }}">{{ $produk['id'] }} - {{ $produk['name'] }} - Rp {{ number_format($produk['harga_jual'], 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <input type="number" name="produk[${produkIndex}][quantity]" placeholder="Quantity" class="quantity-input shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" oninput="calculateTotal()">
                <span class="total-harga-per-produk w-1/4 text-gray-700"></span>
                <button type="button" onclick="removeProduct(this)">Remove</button>
            `;
            produkContainer.appendChild(div);
        }

        function removeProduct(button) {
            button.parentElement.remove();
            calculateTotal();
        }

        function calculateTotal() {
            const productDivs = document.querySelectorAll('#produkContainer .flex');
            let total = 0;
            productDivs.forEach(div => {
                const select = div.querySelector('.produk-select');
                const quantityInput = div.querySelector('.quantity-input');
                const totalPerProduct = div.querySelector('.total-harga-per-produk');
                const price = parseInt(select.selectedOptions[0].getAttribute('data-harga'));
                const quantity = parseInt(quantityInput.value) || 0;
                const totalProduct = price * quantity;
                total += totalProduct;
                totalPerProduct.textContent = 'Rp ' + totalProduct.toLocaleString('id-ID');
            });
            document.getElementById('totalHarga').value = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.getElementById('transactionForm').addEventListener('submit', function(event) {
            event.preventDefault();
            printout();
            setTimeout(() => {
                this.submit();
            }, 1000);
        });

        function printout() {
            const kasirName = "{{ Auth::user()->name }}";
            const totalHarga = document.getElementById('totalHarga').value;
            const produkDivs = document.querySelectorAll('#produkContainer .flex');
            const currentDate = new Date().toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const currentTime = new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Cetak Transaksi</title>');
            printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<div class="container mx-auto p-6">');
            printWindow.document.write('<div class="text-center mb-6">');
            printWindow.document.write('<img src="{{ asset('img/LogoToko.png') }}" alt="Logo Toko Sembako" class="mx-auto w-24 h-24 mb-4">');
            printWindow.document.write('<h4 class="text-3xl font-bold text-green-600">SembakoQU</h4>');
            printWindow.document.write('<h1 class="text-3xl font-bold text-blue-600">Detail Transaksi Penjualan</h1>');
            printWindow.document.write('</div>');
            printWindow.document.write('<p><strong>Tanggal:</strong> ' + currentDate + ' ' + currentTime + '</p>');
            printWindow.document.write('<p><strong>Kasir:</strong> ' + kasirName + '</p>');
            printWindow.document.write('<p><strong>Total Harga:</strong> ' + totalHarga + '</p>');
            printWindow.document.write('<h2 class="text-xl font-bold mt-4">Detail Produk</h2>');
            printWindow.document.write('<ul class="list-disc list-inside">');
            produkDivs.forEach(div => {
                const select = div.querySelector('.produk-select');
                const quantityInput = div.querySelector('.quantity-input');
                const totalPerProduct = div.querySelector('.total-harga-per-produk').textContent;
                const productName = select.selectedOptions[0].textContent.split(' - ')[1];
                const quantity = quantityInput.value;
                printWindow.document.write(`<li>${productName} (Qty: ${quantity}) - Total: ${totalPerProduct}</li>`);
            });
            printWindow.document.write('</ul>');
            printWindow.document.write('</div>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Success',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>

</html>
