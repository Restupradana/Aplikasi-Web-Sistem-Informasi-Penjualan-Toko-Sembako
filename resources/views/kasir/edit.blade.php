@extends('layouts.app')

@section('title', 'Edit Kasir')

@section('content')

<style>
    .container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .input-group {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: calc(50% - 10px);
        cursor: pointer;
    }

    .btn-update {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-update:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        border-color: #6c757d;
        transition: background-color 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    /* Adjust label position */
    .input-group-text {
        width: auto;
        white-space: nowrap;
    }
</style>

<div class="container mt-5">
    <h2>Edit Kasir</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('kasir.update', $kasir['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $kasir['name'] }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $kasir['email'] }}">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="checkbox-container">
            <input type="checkbox" id="showPassword" onchange="togglePasswordVisibility()">
            <label for="showPassword" class="checkbox-label">Tampilkan Password</label>
        </div>
        <br>

        {{-- <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <input type="checkbox" id="showPassword" onchange="togglePasswordVisibility()">
                    </div>
                    <label class="input-group-text" for="showPassword">Tampilkan</label>
                </div>
            </div>
        </div> --}}

        <button type="submit" class="btn btn-update">Update</button>
        <a href="{{ route('kasir.index') }}" class="btn btn-cancel">Cancel</a>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        var checkbox = document.getElementById('showPassword');

        if (checkbox.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }
</script>

@endsection
