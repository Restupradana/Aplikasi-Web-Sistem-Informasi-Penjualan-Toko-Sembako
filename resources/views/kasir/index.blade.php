@extends('layouts.app')

@section('title', 'Daftar Kasir')

@section('content')

<style>
    .custom-bg {
        background: linear-gradient(to right, #2983b8 0%, #9cc94a 100%);
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

    /* Menambahkan warna latar belakang selang-seling */
    .table-container {
        background-color: transparent; /* Atur latar belakang tabel menjadi transparan */
        margin-top: 20px;
        overflow-x: auto; /* Memastikan tabel bisa discroll jika diperlukan */
    }

    table {
        width: 100%;
        background-color: white;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    thead {
        background-color: #333;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.2);
    }

    tbody tr:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .counter-column {
        font-weight: bold;
        color: white; /* Ubah warna tulisan No. menjadi putih */
    }

    .text-center {
        text-align: center;
    }

    .btn-group-action {
        display: flex;
        justify-content: center;
    }

    .btn-action {
        margin: 0 5px;
    }
</style>

<div class="container">
    <div class="custom-bg">
        <h2 class="mb-4 text-center">Daftar Kasir</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-3 text-right">
            <a href="{{ route('kasir.create') }}" class="btn btn-success btn-custom">
                <i class="fas fa-plus"></i> Tambah Kasir
            </a>
        </div>

        <div class="table-container">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="counter-column">No.</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp
                    @foreach ($kasirs as $kasir)
                    <tr>
                        <td >{{ $counter++ }}</td>
                        <td>{{ $kasir['id'] }}</td>
                        <td>{{ $kasir['name'] }}</td>
                        <td>{{ $kasir['email'] }}</td>
                        <td>{{ str_repeat('*', 8) }}</td>
                        <td>
                            <div class="btn-group-action">
                                <a href="{{ route('kasir.edit', $kasir['id']) }}"
                                    class="btn btn-warning btn-sm btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kasir.destroy', $kasir['id']) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action btn-delete"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kasir ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
