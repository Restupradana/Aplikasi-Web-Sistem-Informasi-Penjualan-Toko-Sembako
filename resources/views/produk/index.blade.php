@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<div class="container mt-3">
    <div class="custom-bg p-4 rounded shadow-sm">
        <h1 class="mb-4 text-center">Daftar Produk</h1>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success btn-custom" onclick="window.location.href='/produk/create'">
                <i class="fas fa-plus"></i> Tambah Produk
            </button>
        </div>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if ($kategoriMap->isEmpty() || $produkMap->isEmpty() || $distributorMap->isEmpty())
                        <p>Data tidak tersedia atau terjadi kesalahan.</p>
                    @else
                        <table id="distributorTable" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Distributor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produkMap as $produk)
                                    <tr>
                                        <td>{{ $produk['id'] }}</td>
                                        <td>{{ $kategoriMap[$produk['kategori_id']]['name'] }}</td>
                                        <td>{{ $produk['name'] }}</td>
                                        <td>{{ $produk['harga_beli'] }}</td>
                                        <td>{{ $produk['harga_jual'] }}</td>
                                        <td>{{ $produk['stok'] }}</td>
                                        <td>{{ $distributorMap[$produk['distributor_id']]['name'] }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-primary btn-beli-stok" onclick="beliStok({{ $produk['id'] }})">
                                                    <i class="fas fa-cart-plus"></i> Beli Stok
                                                </button>
                                                <button class="btn btn-warning btn-edit" onclick="editProduk({{ $produk['id'] }})">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-delete" onclick="deleteProduk({{ $produk['id'] }})">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#distributorTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json"
            },
            dom: 'frtip',
            searching: false,
        });
    });

    function beliStok(id) {
        window.location.href = `/produk/${id}/beliStok`;
    }
    
    function editProduk(id) {
        window.location.href = `/produk/${id}/edit`;
    }

    function deleteProduk(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk {{ $produk['name'] }} ?')) {
            $.ajax({
                url: `/produk/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('Produk berhasil dihapus');
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal menghapus produk');
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan saat menghapus produk');
                }
            });
        }
    }
</script>

<style>
    .custom-bg {
        background: linear-gradient(to right, #ecde17e8 0%, #174e50 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: rgb(192, 17, 17);
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

    .table {
        width: 100%;
        margin-top: 20px;
        background-color: #ffffff;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: center;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
    }

    .alert {
        text-align: center;
    }
</style>

@endsection
