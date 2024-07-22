@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transaksi Penjualan</h1>
    <form action="{{ route('transaksi-penjualan.update', $transaksiPenjualan['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kasir_id">Kasir</label>
            <select name="kasir_id" id="kasir_id" class="form-control">
                @foreach ($kasirs as $kasir)
                <option value="{{ $kasir['id'] }}" {{ $kasir['id'] == $transaksiPenjualan['kasir_id'] ? 'selected' : '' }}>{{ $kasir['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="produk">Produk</label>
            @foreach ($transaksiPenjualan['details'] as $detail)
            <select name="produk[][produk_id]" class="form-control">
                @foreach ($produks as $produk)
                <option value="{{ $produk['id'] }}" {{ $produk['id'] == $detail['produk_id'] ? 'selected' : '' }}>{{ $produk['name'] }}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="produk[][quantity]" class="form-control" value="{{ $detail['quantity'] }}" min="1">
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
