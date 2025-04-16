<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Register</button>
        </form>
        <p class="mt-4 text-center text-sm">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>
</body>
</html>