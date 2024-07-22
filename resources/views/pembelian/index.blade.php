@extends('layouts.app')
@section('title', 'Laporan Pembelian Stok Produk')
@section('content')

<div class="custom-bg">
    <h3 class="text-center mb-4 text-white">Laporan Pembelian Stok Produk</h3>

    @if (session('errors'))
        <div class="alert alert-danger">
            {{ session('errors')->first('msg') }}
        </div>
    @endif

    <div class="shadow-md rounded-lg overflow-hidden">
        <table id="pembelianTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Nama Distributor</th>
                    <th>Quantity</th>
                    <th>Harga Beli</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelianList as $index => $pembelian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembelian['name'] }}</td>
                        <td>{{ $pembelian['nama_kategori'] }}</td>
                        <td>{{ $pembelian['nama_distributor'] }}</td>
                        <td>{{ $pembelian['quantity'] }}</td>
                        <td>{{ $pembelian['formatted_harga_beli'] }}</td>
                        <td>{{ $pembelian['formatted_total_harga'] }}</td>
                        <td>{{ $pembelian['tanggal_pembelian'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include DataTables CSS and JS along with Buttons Plugin -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pembelianTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            searching: false
        });
    });
</script>

<style>
    .custom-bg {
        background: linear-gradient(to right, #0c0c0e 0%, #09337c 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: #ffffff;
    }
    .text-center {
        text-align: center;
    }
    .table {
        width: 100%;
        margin: auto;
        background-color: #ffffff;
    }
    .table th, .table td {
        padding: 12px;
        text-align: left;
    }
    .table th {
        background-color: #343a40;
        color: white;
    }
    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    .text-danger {
        color: #dc3545;
    }
</style>

@endsection
