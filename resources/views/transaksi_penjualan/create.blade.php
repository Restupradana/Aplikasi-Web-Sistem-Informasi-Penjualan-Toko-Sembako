@extends('layouts.app')
@section('title', 'Tambah Transaksi Penjualan')
@section('content')

<style>
    .custom-bg {
        background: linear-gradient(to right, #11cb58 0%, #2575fc 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
    }
    .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #ccc;
    }
    .form-label {
        color: white;
    }
    .btn-custom {
        background-color: #ff7f50;
        border-color: #ff7f50;
    }
    .btn-custom:hover {
        background-color: #ff6347;
        border-color: #ff6347;
    }
    .btn-edit {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-edit:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }
    .btn-delete {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-delete:hover {
        background-color: #c82333;
        border-color: #c82333;
    }
    /* Menambahkan warna latar belakang selang-seling */
    #produkTable tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.2);
    }
    #produkTable tbody tr:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

<div class="container mt-5">
    <div class="custom-bg">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">Tambah Transaksi Penjualan</h1>

        <form action="{{ route('transaksi_penjualan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kasir_id">Kasir:</label>
                <select class="form-control" id="kasir_id" name="kasir_id" required>
                    @foreach($kasirList as $kasir)
                        <option value="{{ $kasir['id'] }}">{{ $kasir['name'] }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label for="produk" class="block text-gray-700 text-sm font-bold mb-2">Produk:</label>
                <div id="produkContainer">
                    <div class="flex mb-2 items-center">
                        <select name="produk[0][produk_id]" class="produk-select shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                            @foreach($produkList as $produk)
                                <option value="{{ $produk['id'] }}" data-harga="{{ $produk['harga_jual'] }}">{{ $produk['id'] }} - {{ $produk['name'] }} - Rp {{ number_format($produk['harga_jual'], 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="produk[0][quantity]" placeholder="Quantity" class="quantity-input shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" oninput="calculateTotal()">
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
                <input type="text" id="totalHarga" name="totalHarga" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100">
            </div>

            <div class="text-right">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function addProduct() {
        const container = document.getElementById('produkContainer');
        const productCount = container.children.length;

        const productDiv = document.createElement('div');
        productDiv.className = 'flex mb-2 items-center';
        productDiv.innerHTML = `
            <select name="produk[${productCount}][produk_id]" class="produk-select shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                @foreach($produkList as $produk)
                    <option value="{{ $produk['id'] }}" data-harga="{{ $produk['harga_jual'] }}">{{ $produk['id'] }} - {{ $produk['name'] }} - Rp {{ number_format($produk['harga_jual'], 0, ',', '.') }}</option>
                @endforeach
            </select>
            <input type="number" name="produk[${productCount}][quantity]" placeholder="Quantity" class="quantity-input shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" oninput="calculateTotal()">
            <span class="total-harga-per-produk w-1/4 text-gray-700"></span>
            <button type="button" onclick="removeProduct(this)">Remove</button>
        `;
        container.appendChild(productDiv);
    }

    function removeProduct(button) {
        const container = document.getElementById('produkContainer');
        container.removeChild(button.parentElement);
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
</script>

<script>
    let productIndex = 1;

    function addProduct() {
        const container = document.getElementById('produkContainer');
        const newProduct = document.createElement('div');
        newProduct.classList.add('flex', 'mb-2', 'items-center');
        newProduct.innerHTML = `
            <select name="produk[${productIndex}][produk_id]" class="produk-select shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2" onchange="calculateTotal()">
                @foreach($produkList as $produk)
                    <option value="{{ $produk['id'] }}" data-harga="{{ $produk['harga_jual'] }}">{{ $produk['id'] }} - {{ $produk['name'] }} - Rp {{ number_format($produk['harga_jual'], 0, ',', '.') }}</option>
                @endforeach
            </select>
            <input type="number" name="produk[${productIndex}][quantity]" placeholder="Quantity" class="quantity-input shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" oninput="calculateTotal()">
            <span class="total-harga-per-produk w-1/4 text-gray-700"></span>
            <button type="button" onclick="removeProduct(this)">Remove</button>
        `;
        container.appendChild(newProduct);
        productIndex++;
        calculateTotal();
    }

    function removeProduct(button) {
        button.parentElement.remove();
        calculateTotal();
    }

    function calculateTotal() {
        const produkSelects = document.querySelectorAll('.produk-select');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const totalHargaPerProdukElements = document.querySelectorAll('.total-harga-per-produk');
        let totalHarga = 0;

        produkSelects.forEach((select, index) => {
            const harga = select.options[select.selectedIndex].dataset.harga;
            const quantity = quantityInputs[index].value;
            const totalHargaPerProduk = harga * quantity;

            // Update total harga per produk
            totalHargaPerProdukElements[index].textContent = totalHargaPerProduk.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            
            // Update total harga semua produk
            totalHarga += totalHargaPerProduk;
        });

        document.getElementById('totalHarga').value = totalHarga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    }
</script>
@endsection
