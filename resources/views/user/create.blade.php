@extends('layouts.app')
@section('title', 'Tambah User')
@section('content')

<style>
    .custom-bg {
        background: linear-gradient(to right, #11cb58 0%, #2575fc 100%);
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

    .btn-cancel {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<div class="container mt-4">
    <div class="custom-bg">
        <h1 class="mb-4">Tambah User</h1>

        <!-- Menampilkan error validasi -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                <label for="showPassword" class="checkbox-label">Tampilkan Password</label>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Jabatan:</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected>Pilih Jabatan...</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

            <button type="submit" class="btn btn-custom">Tambah</button>
            <a href="{{ route('user.index') }}" class="btn btn-cancel">Cancel</a>
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }
</script>

@endsection
