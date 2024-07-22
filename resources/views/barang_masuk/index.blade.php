@extends('layouts.app' )

@section('content')
<div class="container">
    <h1>Barang Masuk</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Distributor</th>
                <th>Quantity</th>
                <th>Harga Beli</th>
                <th>Total Harga</th> {{-- Tambah kolom Total Harga --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($paginatedItems as $item)
                <tr>
                    <td>{{ $loop->iteration + $paginatedItems->firstItem() - 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['kategori_name'] }}</td>
                    <td>{{ $item['distributor_name'] }}</td>
                    <td>{{ is_numeric($item['quantity']) ? $item['quantity'] : 'N/A' }}</td>
                    <td>{{ is_numeric($item['harga_beli']) ? $item['harga_beli'] : 'N/A' }}</td>
                    <td>
                        @if (is_numeric($item['quantity']) && is_numeric($item['harga_beli']))
                            {{ $item['quantity'] * $item['harga_beli'] }}
                        @else
                            N/A
                        @endif
                    </td> {{-- Hitung Total Harga --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $paginatedItems->links() }}
</div>
@endsection
