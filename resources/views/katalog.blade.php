<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-semibold">Katalog Produk</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('home') }}" class="text-white hover:underline">Dashboard</a>
            
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
            <h2 class="text-3xl font-bold mb-4">Selamat datang di Katalog Produk</h2>
            <p class="text-gray-600">Jelajahi produk-produk berkualitas dari UMKM kami.</p>
            <form method="GET" action="{{ route('catalogFilter') }}" class="mt-6 flex flex-col sm:flex-row justify-center items-center gap-4">
                <input type="text" name="search" placeholder="Cari produk..." 
                    value="{{ request('search') }}"
                    class="px-4 py-2 w-full sm:w-auto rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            
                <select name="category" class="px-4 py-2 w-full sm:w-auto rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>
            
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Cari
                </button>
            
                <a href="{{ route('catalogFilter') }}" class="text-sm text-red-600 hover:underline">Reset</a>
            </form>
            
        </div>

        <!-- Produk -->
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white shadow rounded p-4">
                    @if ($product->gambar)
                    <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-48 object-cover">
                    @else
                        <div class="h-40 w-full bg-gray-200 flex items-center justify-center text-sm text-gray-500 rounded mb-3">
                            Tidak ada gambar
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold">{{ $product->nama }}</h3>
                    <p class="text-blue-600 font-bold mb-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600">Kategori: {{ $product->category->nama ?? '-' }}</p>
                </div>
            @empty
                <div class="bg-white shadow rounded p-4 text-center col-span-full">
                    <p class="text-gray-500 italic">Belum ada produk</p>
                </div>
            @endforelse
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
