@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<style>
    .custom-bg {
        background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #ccc;
        width: 100%;
        padding: 8px 12px;
        margin-bottom: 10px;
    }

    .form-label {
        color: white;
        font-weight: bold;
    }

    .btn-custom {
        background-color: #f64f59;
        border-color: #f64f59;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #ff7a7f;
        border-color: #ff7a7f;
    }
</style>

<div class="container mt-4">
    <div class="custom-bg">
        <h1 class="mb-4">Edit User</h1>

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

        <form action="{{ route('user.update', $user['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}"
                    required>
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
                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ $user['role'] == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                    <option value="owner" {{ $user['role'] == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

            <button type="submit" class="btn btn-custom">Simpan</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
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
