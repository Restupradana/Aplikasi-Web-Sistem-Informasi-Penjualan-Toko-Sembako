@extends('layouts.app')
@section('title', 'Tambah Kategori')
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
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-primary {
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

        .btn-primary:hover {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        .btn-cancel {
            background-color: #f44336;
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

        .btn-cancel:hover {
            background-color: white;
            color: #f44336;
            border: 2px solid #f44336;
        }
    </style>

    <div class="container">
        <div class="custom-bg">
            <h1>Tambah Kategori</h1>

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
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Nama:</label>
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn-primary">Tambah</button>
                        <a href="{{ route('kategori.index') }}" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
