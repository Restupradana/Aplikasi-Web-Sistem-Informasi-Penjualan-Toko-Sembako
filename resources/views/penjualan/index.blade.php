@extends('layouts.app')
@section('title', 'Laporan Transaksi Penjualan')
@section('content')

<div class="custom-bg">
    <h3 class="text-center mb-4 text-white">Laporan Transaksi Penjualan</h3>

    @if (isset($error))
        <p class="text-danger">{{ $error }}</p>
    @else
        <div class="shadow-md rounded-lg overflow-hidden">
            <table id="transaksiTable" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th> <!-- New column for row numbers -->
                        <th>Transaksi ID</th>
                        <th>Kasir</th>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                @php $rowNumber = 1; @endphp <!-- Initialize counter -->
                @foreach ($transaksis as $transaksi)
                    @foreach ($transaksi['details'] as $detail)
                        <tr>
                            <td>{{ $rowNumber++ }}</td> <!-- Incrementing counter for each row -->
                            <td>{{ $transaksi['id'] }}</td>
                            <td>{{ $transaksi['kasir']['name'] }}</td>
                            <td>{{ $produkMap[$detail['produk_id']]['name'] }}</td>
                            <td>{{ $detail['quantity'] }}</td>
                            <td>Rp {{ number_format($detail['total_price'], 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi['created_at'])->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
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
        $('#transaksiTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json" // Using Indonesian.json for Indonesian language
            },
            dom: 'Bfrtip', // Adding Buttons row above the table
            buttons: [
                'copy', 'csv', 'excel', 'print' // Adding export buttons
            ],
            searching: false // Disable the search feature
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
