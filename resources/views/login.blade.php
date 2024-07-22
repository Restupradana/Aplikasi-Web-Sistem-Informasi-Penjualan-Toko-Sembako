<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tambahkan Tailwind CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded-lg flex max-w-4xl w-full">
            <!-- Left Section: Logo and Welcome Message -->
            <div class="w-1/2 bg-gradient-to-r from-gray-800 to-gray-600 text-white flex flex-col justify-center items-center p-8 rounded-l-lg">
                <div class="text-center">
                    <img src="{{ asset('img/LogoToko.png') }}" alt="Logo" class="w-32 mb-4">
                    <h1 class="text-4xl font-bold mb-2">Selamat Datang</h1>
                    <p class="text-lg">Silakan masuk untuk melanjutkan</p>
                </div>
            </div>
            <!-- Right Section: Login Form -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-bold mb-4">Login</h2>
                @if ($errors->any())
                    <div class="mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg class="h-6 text-gray-700" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                                    <path id="eye-icon" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path id="eye-off-icon" style="display:none;" d="M10.94 12.07a3 3 0 004.01-.57l-4.01-.45-.45-4.01a3 3 0 00-.57 4.01zm3.66 3.66a7.98 7.98 0 01-10.88-10.88l1.06-1.06 10.88 10.88-1.06 1.06zm1.06-12.96a7.98 7.98 0 0110.88 10.88l-1.06 1.06-10.88-10.88 1.06-1.06z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.display = 'inline';
                eyeOffIcon.style.display = 'none';
            }
        }
    </script>
</body>
</html>
