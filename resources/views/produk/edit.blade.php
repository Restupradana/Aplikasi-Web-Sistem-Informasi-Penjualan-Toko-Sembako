@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<style>
    .custom-bg {
        background: linear-gradient(to right, #11cb58 0%, #2575fc 100%);
        color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #ccc;
    }

    .form-label {
        color: white;
    }

    .btn-primary {
        background-color: #ff7f50;
        border-color: #ff7f50;
    }

    .btn-primary:hover {
        background-color: #ff6347;
        border-color: #ff6347;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<div class="container mt-4">
    <div class="custom-bg">
        <h1 class="mb-4">Edit Produk</h1>

        <!-- Menampilkan error validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('produk.update', $produk['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $produk['name']) }}" required>
            </div>

            <div class="mb-3">
                <label for="harga_beli" class="form-label">Harga Beli:</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                    value="{{ old('harga_beli', $produk['harga_beli']) }}" required>
            </div>

            <div class="mb-3">
                <label for="harga_jual" class="form-label">Harga Jual:</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                    value="{{ old('harga_jual', $produk['harga_jual']) }}" readonly required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok"
                    value="{{ old('stok', $produk['stok']) }}" readonly required>
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori:</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    @foreach ($kategoriMap as $kategori)
                        <option value="{{ $kategori['id'] }}" {{ $kategori['id'] == old('kategori_id', $produk['kategori_id']) ? 'selected' : '' }}>
                            {{ $kategori['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="distributor_id" class="form-label">Distributor:</label>
                <select class="form-control" id="distributor_id" name="distributor_id" required>
                    @foreach ($distributorMap as $distributor)
                        <option value="{{ $distributor['id'] }}" {{ $distributor['id'] == old('distributor_id', $produk['distributor_id']) ? 'selected' : '' }}>
                            {{ $distributor['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hargaBeliInput = document.getElementById('harga_beli');
        const hargaJualInput = document.getElementById('harga_jual');

        // Function to update harga_jual based on harga_beli
        function updateHargaJual() {
            const hargaBeli = parseFloat(hargaBeliInput.value);
            if (!isNaN(hargaBeli)) {
                const hargaJual = hargaBeli * 1.2; // Menghitung harga jual dengan margin 20%
                hargaJualInput.value = hargaJual.toFixed(2); // Mengisi input harga jual
            } else {
                hargaJualInput.value = '';
            }
        }

        // Update harga_jual when the page loads
        updateHargaJual();

        // Add event listener to update harga_jual when harga_beli changes
        hargaBeliInput.addEventListener('input', updateHargaJual);
    });
</script>

@endsection
