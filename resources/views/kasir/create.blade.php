@extends('layouts.app')

@section('title', 'Tambah Kasir')

@section('content')

<style>
    .custom-bg {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .form-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #333; /* Ubah warna label agar kontras dengan latar belakang form */
    }

    .form-input {
        width: 100%;
        padding: 8px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        margin-top: 0.5rem;
    }

    .checkbox-label {
        margin-left: 0.5rem;
        color: #333; /* Ubah warna label agar kontras dengan latar belakang form */
    }

    .btn-custom {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-custom:hover {
        background-color: #45a049;
        color: white;
    }

    .btn-cancel {
        background-color: #ccc; /* Warna untuk tombol cancel */
        border: none;
        color: #333; /* Warna teks untuk tombol cancel */
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-cancel:hover {
        background-color: #bbb; /* Warna hover untuk tombol cancel */
    }
</style>

<div class="container">
    <div class="custom-bg">
        <h1 class="mb-4">Tambah Kasir</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-container">
            <form action="{{ route('kasir.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-input">
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                    <label for="showPassword" class="checkbox-label">Tampilkan Password</label>
                </div>

                <button type="submit" class="btn btn-custom mt-3">Tambah</button>
                <a href="{{ route('kasir.index') }}" class="btn btn-cancel mt-3 ml-2">Cancel</a>
            </form>
        </div>
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
