<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-r from-gray-800 to-gray-600 text-white">
            <div class="p-6 text-center text-2xl font-bold">Dashboard</div>
            <ul>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="block flex items-center">
                        <i class="fas fa-tachometer-alt pr-2"></i>
                        Dashboard
                    </a>
                </li>
                @if (auth()->user()->role == 'karyawan')
                    <li class="px-4 py-2 hover:bg-gray-700">
                        <a href="{{ route('transaksi_kasir.index') }}" class="block flex items-center">
                            <i class="fas fa-cogs pr-2"></i>
                            Kasir
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'admin')
                    <li class="px-4 py-2 hover:bg-gray-700">
                        <a href="{{ route('produk.index') }}" class="block flex items-center">
                            <i class="fas fa-user-graduate pr-2"></i>
                            Admin
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'owner')
                    <li class="px-4 py-2 hover:bg-gray-700">
                        <a href="{{ route('penjualan.index') }}" class="block flex items-center">
                            <i class="fas fa-chalkboard-teacher pr-2"></i>
                            Owner
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <div class="flex justify-between items-center p-6 bg-white shadow-md">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <div class="flex items-center">
                    <span class="mr-4">Hello, {{ Auth::user()->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            <div class="container mx-auto p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-6">
                            <h5 class="card-title text-xl font-semibold mb-4">Poster SembakoQu</h5>
                            <p class="card-text mb-4">Ini adalah gambar poster aplikasi kelompok kami</p>
                            <img src="{{ asset('img/RevPoster.jpeg') }}" class="img-fluid" alt="Poster SembakoQu">
                        </div>
                    </div>
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="card-body p-6">
                            <h5 class="card-title text-xl font-semibold mb-4">Logo SembakoQu</h5>
                            <p class="card-text mb-4">Ini adalah logo toko SembakoQu</p>
                            <img src="{{ asset('img/LogoToko.png') }}" class="img-fluid" alt="Logo SembakoQu">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
