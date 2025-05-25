<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - UMKM Helm</title>
    @vite('resources/css/app.css')
    <!-- Include Glide.js for carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.min.css">
    <style>
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            height: 200px;
            object-fit: contain;
            background-color: #f5f5f5;
        }

        .price-tag {
            background-color: #3b82f6;
            color: white;
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        .category-badge {
            background-color: #e5e7eb;
            color: #4b5563;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-semibold">UMKM Helm</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('dashboard') }}" class="text-white hover:underline">Dashboard</a>
                <a href="{{ route('katalog') }}" class="text-white font-semibold underline">Katalog</a>

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
    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl p-8 mb-10 text-white shadow-lg">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Katalog Produk Helm</h1>
                <p class="text-lg mb-6">Temukan helm berkualitas dengan harga terbaik untuk keselamatan berkendara Anda
                </p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('catalogFilter') }}"
                class="flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-grow w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                        class="px-4 py-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" />
                </div>

                <div class="w-full md:w-auto">
                    <select name="category"
                        class="px-4 py-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari
                    </button>
                    <a href="{{ route('katalog') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg transition flex items-center gap-2">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Daftar Produk
            </h2>

            @if ($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div
                            class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg cursor-default">
                            <div class="relative">
                                @if ($product->gambar)
                                    <img src="{{ asset('uploads/products/' . $product->gambar) }}"
                                        alt="{{ $product->nama }}" class="product-image w-full">
                                @else
                                    <div class="product-image w-full flex items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                @if ($product->is_new)
                                    <span
                                        class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">BARU</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg truncate">{{ $product->nama }}</h3>
                                    <span class="price-tag">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="category-badge">{{ $product->category->nama ?? 'Uncategorized' }}</span>
                                    <span class="text-xs text-gray-500">Stok: {{ $product->stok }}</span>
                                </div>
                                <div class="mt-3 flex justify-between items-center">
                                    <button class="text-blue-600 text-sm font-medium cursor-default">
                                        Lihat Detail →
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 mb-4">Coba gunakan kata kunci atau filter yang berbeda</p>
                    <a href="{{ route('katalog') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Reset Pencarian
                    </a>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer (tetap sama) -->
    <footer class="bg-gray-800 text-white py-8">
        <!-- ... -->
    </footer>

    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-6">
                <!-- Tentang Kami -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Tentang UMKM Helm</h3>
                    <p class="text-gray-400 mb-4">Penyedia helm berkualitas dengan standar keamanan tinggi sejak 2010.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Jam Operasional</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex justify-between">
                            <span>Senin-Jumat</span>
                            <span>09:00 - 20:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu</span>
                            <span>10:00 - 18:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Minggu</span>
                            <span>10:00 - 15:00</span>
                        </li>
                        <li class="pt-2 text-sm italic">
                            *Hari libur jam operasional mungkin berubah
                        </li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Layanan Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Penjualan Helm</a></li>
                        <li><a href="#" class="hover:text-white">Perawatan Helm</a></li>
                        <li><a href="#" class="hover:text-white">Custom Design Helm</a></li>
                        <li><a href="#" class="hover:text-white">Penggantian Sparepart</a></li>
                        <li><a href="#" class="hover:text-white">Konsultasi Produk</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>cs@umkmhelm.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Raya Keselamatan No. 123<br>Jakarta Selatan, 12345</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
                <div class="mb-2">
                    &copy; {{ date('Y') }} UMKM Helm. All rights reserved. |
                    <a href="#" class="hover:text-white">Kebijakan Privasi</a> |
                    <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
