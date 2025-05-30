<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Login - UMKM Helm</title>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center min-h-screen font-sans">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-blue-600 hover:underline flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 011.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <h2 class="text-3xl font-extrabold text-center text-blue-700 mb-6">Login</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700 font-medium">Username</label>
                <input type="text" name="username" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                       placeholder="Masukkan username Anda">
            </div>

            <div>
                <label class="block text-sm text-gray-700 font-medium">Password</label>
                <input type="password" name="password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                       placeholder="••••••••">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                Masuk
            </button>
        </form>

        {{-- <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Daftar di sini</a>
        </p> --}}
    </div>
</body>
</html>
