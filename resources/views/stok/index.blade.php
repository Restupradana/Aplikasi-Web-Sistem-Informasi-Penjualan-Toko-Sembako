@extends('layouts.app')
@section('title', 'Laporan Sisa Stok')
@section('content')

<div class="container mt-5">
    <div class="custom-bg p-4 rounded shadow-sm">
        <h3 class="text-center mb-4 text-white">Laporan Sisa Stok</h3>

        @if (isset($error))
            <p class="text-danger text-center">{{ $error }}</p>
        @else
        
            <div class="shadow-md rounded-lg">
                <table id="produkTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Distributor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rowNumber = 1; @endphp
                        @foreach ($produks as $produk)
                            <tr>
                                <td>{{ $rowNumber++ }}</td>
                                <td>{{ $kategoriMap[$produk['kategori_id']]['name'] ?? 'Unknown' }}</td>
                                <td>{{ $produk['name'] }}</td>
                                <td>{{ $produk['stok'] }}</td>
                                <td>{{ $distributorMap[$produk['distributor_id']]['name'] ?? 'Unknown' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
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
        $('#produkTable').DataTable({
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
        margin-top: 20px; /* Added margin top */
        background-color: #ffffff;
    }
    .table th, .table td {
        padding: 15px; /* Increased padding for better spacing */
        text-align: center;
    }
    .table th {
        background-color: #343a40;
        color: white;
    }
    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    .table tbody tr:hover {
        background-color: #e9ecef;
    }
    .text-danger {
        color: #dc3545;
    }
</style>

@endsection
