<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Kasir</title>
    <!-- CSS dan JS yang diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">SembakoQu</a>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <!-- Navbar-->
        <div class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
            <span class="mr-4">Hello, {{ Auth::user()->name }}!</span>
        </div>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <span class="mr-4">Hello, {{ Auth::user()->name }}!</span>
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-black py-2 px-4 rounded">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Transaksi Kasir</li>
                    </ol>
                </div>
                <div class="container mx-auto p-6 bg-gray-100">
                    <div class="custom-bg">
                        <h1 class="text-3xl font-bold mb-8 text-center">Data Transaksi Penjualan</h1>

                        <div class="flex justify-end mb-4">
                            <div class="bg-green-100 p-4 rounded-lg border border-green-500">
                                <a href="{{ route('transaksi_kasir.create') }}" 
                                   class="btn btn-success btn-custom items-center">
                                    <i class="fas fa-plus mr-2"></i> <!-- Ikon plus -->
                                    Tambah Transaksi
                                </a>
                            </div>
                        </div>

                        
                        

                        @if (isset($error))
                            <p class="text-red-500">{{ $error }}</p>
                        @else
                            <div class="bg-blue-100 shadow-md rounded-lg overflow-hidden">
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
                                            <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">{{ $transaksi['id'] }}</td>
                                                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($transaksi['created_at'])->format('d-F-Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">{{ $transaksi['kasir']['name'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">Rp {{ number_format($transaksi['total_price'], 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-center">
                                                    <button class="btn-details bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" onclick="openModal({{ json_encode($transaksi['details']) }})">View Details</button>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-center">
                                                    <button class="btn-print bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="printTransaction({{ json_encode($transaksi) }})">
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
                            <div class="modal-header bg-blue-500 text-black">
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
                        background: linear-gradient(to right, #ffffff 0%, #f0f0f0 100%);
                        padding: 30px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                        color: #000;
                    }

                    .form-control {
                        background: rgba(255, 255, 255, 0.9);
                        border: 1px solid #ccc;
                    }

                    .form-label {
                        color: #000;
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
                    #produkTable tbody tr:nth-child(even) {
                        background-color: rgba(255, 255, 255, 0.1);
                    }

                    #produkTable tbody tr:nth-child(odd) {
                        background-color: rgba(255, 255, 255, 0.05);
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
                        printWindow.document.write('<p><strong>Tanggal Transaksi:</strong> ' + new Date(transaksi.created_at).toLocaleString('id-ID', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        }) + '</p>');
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
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JS yang diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>

</html>
