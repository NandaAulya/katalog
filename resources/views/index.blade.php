<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-semibold">Dashboard</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('katalog') }}" class="text-white hover:underline">Katalog</a>
            
                @auth
                    <span class="text-white">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-200 hover:underline">Logout</button>
                    </form>
                @endauth
            
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:underline">Login</a>
                @endguest
            </div>
            
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Selamat datang di Dashboard</h2>
            <p class="text-gray-600">Gunakan navigasi di atas untuk mengelola produk atau melihat katalog.</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-12">
        <div class="max-w-7xl mx-auto text-center text-sm">
            &copy; {{ date('Y') }} UMKM Helm. All rights reserved.
        </div>
    </footer>

</body>
</html>
