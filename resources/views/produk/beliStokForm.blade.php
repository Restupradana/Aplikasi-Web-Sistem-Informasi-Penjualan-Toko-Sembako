@extends('layouts.app')
@section('title', 'Beli Stok Produk')
@section('content')

<style>
    .white-text-input {
        color: white;
    }

    .custom-bg {
        background: linear-gradient(to right, #11cb58 0%, #0a0f16 100%);
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

    .btn-cancel {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<div class="container mt-5">
    <div class="custom-bg">
        <h1 class="mb-4 text-center">Beli Stok Produk</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produk.beliStokProcess', $produk['id']) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $produk['name'] }}" disabled>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
                <label for="harga_beli" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ $produk['harga_beli'] }}" readonly required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success btn-custom">Beli Stok</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
