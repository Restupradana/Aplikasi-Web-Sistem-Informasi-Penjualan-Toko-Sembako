@extends('layouts.app')
@section('title', 'Transaksi Penjualan')
@section('content')

<div class="container mx-auto p-6 bg-gray-100">
    <div class="custom-bg p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Data Transaksi Penjualan</h1>

        {{-- <div class="flex justify-end mb-4">
            <a href="{{ route('transaksi_penjualan.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i> <!-- Ikon plus -->
                Tambah Transaksi
            </a>
        </div> --}}

        @if (isset($error))
            <p class="text-red-500">{{ $error }}</p>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table id="transaksiTable" class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-6 py-3 border-b border-gray-300">ID</th>
                            <th class="px-6 py-3 border-b border-gray-300">Tanggal Transaksi</th>
                            <th class="px-6 py-3 border-b border-gray-300">Kasir</th>
                            <th class="px-6 py-3 border-b border-gray-300">Total Harga</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-center">Detail</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-center">Cetak Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-gray-50' }}">
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">{{ $transaksi['id'] }}</td>
                                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($transaksi['created_at'])->format('d-F-Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">{{ $transaksi['kasir']['name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">Rp {{ number_format($transaksi['total_price'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-center">
                                    <button 
                                        class="btn-details bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        onclick="openModal({{ json_encode($transaksi['details']) }})">
                                        View Details
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-center">
                                    <button 
                                        class="btn-print bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500"
                                        onclick="printTransaction({{ json_encode($transaksi) }})">
                                        <i class="fas fa-print"></i> <!-- Ikon cetak -->
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="detailModal" class="modal fade" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-500 text-white">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="modalDetails" class="list-disc list-inside">
                    <!-- Details will be injected here by JavaScript -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .custom-bg {
        background: linear-gradient(to right, #ffffff 0%, #f3f4f6 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: #333;
    }
    .btn-details {
        background-color: #3182ce;
        border-color: #3182ce;
        transition: background-color 0.3s ease;
    }
    .btn-details:hover {
        background-color: #2c5282;
        border-color: #2c5282;
    }
    .btn-print {
        background-color: #4a5568;
        border-color: #4a5568;
        transition: background-color 0.3s ease;
    }
    .btn-print:hover {
        background-color: #2d3748;
        border-color: #2d3748;
    }
    /* Selang-seling background tabel */
    #transaksiTable tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }
    #transaksiTable tbody tr:nth-child(odd) {
        background-color: #edf2f7;
    }
</style>

<script>
    function openModal(details) {
        const modalDetails = document.getElementById('modalDetails');
        modalDetails.innerHTML = '';

        details.forEach(detail => {
            const unitPrice = detail.total_price / detail.quantity; // Menghitung harga per piece
            const listItem = document.createElement('li');
            listItem.textContent = `${detail.produk.name} (Qty: ${detail.quantity}, Harga /pc: Rp ${new Intl.NumberFormat('id-ID').format(unitPrice)}) - Total: Rp ${new Intl.NumberFormat('id-ID').format(detail.total_price)}`;
            modalDetails.appendChild(listItem);
        });

        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
        modal.show();
    }

    function printTransaction(transaksi) {
        const printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Cetak Transaksi</title>');
        printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="container mx-auto p-6">');
        printWindow.document.write('<div class="text-center mb-6">');
        printWindow.document.write('<img src="{{ asset('img/LogoToko.png') }}" alt="Logo Toko Sembako" class="mx-auto w-24 h-24 mb-4">'); // Pastikan path sesuai
        printWindow.document.write('<h4 class="text-3xl font-bold text-green-600">SembakoQU</h4>');
        printWindow.document.write('<h1 class="text-3xl font-bold text-blue-600">Detail Transaksi Penjualan</h1>');
        printWindow.document.write('</div>');
        printWindow.document.write('<p><strong>Transaksi ID:</strong> ' + transaksi.id + '</p>');
        printWindow.document.write('<p><strong>Kasir:</strong> ' + transaksi.kasir.name + '</p>');
        printWindow.document.write('<p><strong>Total Harga:</strong> Rp ' + new Intl.NumberFormat('id-ID').format(transaksi.total_price) + '</p>');
        printWindow.document.write('<p><strong>Tanggal Transaksi:</strong> ' + new Date(transaksi.created_at).toLocaleString('id-ID', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }) + '</p>');
        printWindow.document.write('<h2 class="text-xl font-bold mt-4">Detail Produk</h2>');
        printWindow.document.write('<ul class="list-disc list-inside">');
        
        transaksi.details.forEach(detail => {
            const unitPrice = detail.total_price / detail.quantity;
            printWindow.document.write(`<li>${detail.produk.name} (Qty: ${detail.quantity}, Harga /pc: Rp ${new Intl.NumberFormat('id-ID').format(unitPrice)}) - Total: Rp ${new Intl.NumberFormat('id-ID').format(detail.total_price)}</li>`);
        });

        printWindow.document.write('</ul>');
        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Tunggu hingga konten selesai dimuat sebelum memanggil print
        printWindow.onload = function() {
            printWindow.print();
            printWindow.onafterprint = function() {
                printWindow.close();
            };
        };
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#transaksiTable').DataTable({
            "pageLength": 5, // Membatasi jumlah entri per halaman menjadi 5
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json"
            },
            dom: 'frtip',
            searching: false
        });
    });
</script>

@endsection
