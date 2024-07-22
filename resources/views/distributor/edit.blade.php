@extends('layouts.app')
@section('title', 'Edit Distributor')
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
            <h1 class="mb-4">Edit Distributor</h1>

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

            <form action="{{ route('distributor.update', $distributor['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $distributor['name'] }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ $distributor['email'] }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Kontak:</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $distributor['phone'] }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat:</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $distributor['address'] }}" required>
                </div>

                <button type="submit" class="btn btn-custom">Simpan</button>
                <a href="{{ route('distributor.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    
@endsection
