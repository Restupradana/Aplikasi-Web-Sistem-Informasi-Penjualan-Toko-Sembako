@extends('layouts.app')

@section('title', 'Distributor')

@section('content')


<div class="container mt-3">
    <div class="custom-bg p-4 rounded shadow-sm">
        <h1 class="mb-4 text-center">Daftar Distributor</h1>
        {{-- Tombol tambah distributor --}}
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success btn-custom" onclick="window.location.href='/distributor/create'">
                <i class="fas fa-plus"></i> Tambah Distributor
            </button>
        </div>

        @if(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        @if($distributorMap->isEmpty())
            <div class="alert alert-info">
                Tidak ada data distributor yang tersedia.
            </div>
        @else
            <table id="distributorTable" class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Distributor</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($distributorMap as $distributor)
                        <tr>
                            <td>{{ $distributor['id'] }}</td>
                            <td>{{ $distributor['name'] }}</td>
                            <td>{{ $distributor['email'] }}</td>
                            <td>{{ $distributor['phone'] }}</td>
                            <td>{{ $distributor['address'] }}</td>
                            <td>
                                <a href="{{ route('distributor.edit', $distributor['id']) }}" class="btn btn-warning btn-sm btn-edit">Edit</a>
                                <form action="{{ route('distributor.delete', $distributor['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus distributor {{ $distributor['name'] }} ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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
            searching: false
        });
    });
</script>

<style>
    .custom-bg {
        background: linear-gradient(to right, #11cb58 0%, #0a0f16 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

    .table th, .table td {
        padding: 15px;
        text-align: center;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    /* Menambahkan warna latar belakang selang-seling */
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
