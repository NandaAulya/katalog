<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $product->nama }} | UMKM Agus Jaya</title>

    @vite(['resources/css/app.css', 'resources/js/detailProducts.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .swiper-slide img {
            max-height: 400px;
            object-fit: contain;
            border-radius: 0.75rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans min-h-screen">
    <x-navbar />

    <main class="container mx-auto px-4 py-10 space-y-12">
        
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('katalog') }}" class="text-white bg-gray-500 hover:bg-gray-700 rounded-lg px-4 py-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Detail Produk -->
        <section class="bg-white rounded-3xl shadow-xl p-6 md:p-10 md:flex gap-8">
            <!-- Gambar -->
            <div class="md:w-1/2">
                <div class="swiper">
                    <div class="swiper-wrapper content-center">
                        @forelse ($product->images as $image)
                            <div class="swiper-slide flex justify-center items-center">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->nama }}"
                                    class="w-full max-w-xs md:max-w-md max-h-80 object-contain mx-auto" />

                            </div>
                        @empty
                            <div class="swiper-slide flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-image text-6xl"></i>
                                <p class="mt-2">Gambar tidak tersedia</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Navigasi Swiper -->
                    <div class="swiper-pagination mt-4"></div>
                    <div class="swiper-button-next text-blue-500"></div>
                    <div class="swiper-button-prev text-blue-500"></div>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="md:w-1/2 mt-8 md:mt-0 flex flex-col justify-between">
                <div>
                    <span
                        class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full uppercase font-semibold tracking-wide mb-4">
                        {{ $product->category->nama ?? 'Uncategorized' }}
                    </span>

                    <h1 class="text-4xl font-extrabold mb-3">{{ $product->nama }}</h1>
                    <div class="text-2xl font-bold text-blue-600 mb-4">
                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                    </div>

                    <div class="mb-6 text-lg">
                        @if ($product->stok > 0)
                            <span class="flex items-center text-green-600 font-medium">
                                <i class="fas fa-check-circle mr-2"></i>
                                Stok tersedia: {{ $product->stok }} unit
                            </span>
                        @else
                            <span class="flex items-center text-red-600 font-medium">
                                <i class="fas fa-times-circle mr-2"></i>
                                Stok habis
                            </span>
                        @endif
                    </div>
                </div>

                <!-- CTA -->
                <div class="mt-8 space-y-4">
                    <h2 class="text-xl font-bold">Beli Sekarang!</h2>
                    <div class="flex flex-wrap gap-4">
                        <a href="https://wa.me/6281803185594?text=Saya%20tertarik%20dengan%20produk%20{{ urlencode($product->nama) }}%20(%20Rp%20{{ number_format($product->harga, 0, ',', '.') }})%20di%20UMKM%20Agus%20Jaya"
                            target="_blank"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center transition">
                            <i class="fab fa-whatsapp mr-2"></i> BELI VIA WHATSAPP
                        </a>

                        <a href="/maps" target="_blank"
                            class="border border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-lg font-medium inline-flex items-center transition">
                            <i class="fas fa-map-marker-alt mr-2"></i> DATANG KE TOKO
                        </a>
                    </div>
                </div>

                <!-- Fitur -->
                <div class="mt-8 border-t border-gray-200 pt-4 space-y-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-blue-500"></i>
                        Bergaransi Pemeliharaan Dari Penjual Langsung
                    </div>
                </div>
            </div>
        </section>

        <!-- Deskripsi -->
        <section class="bg-white rounded-3xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $product->deskripsi ?? 'Deskripsi produk belum tersedia.' }}
            </p>
        </section>

        <!-- Produk Terkait -->
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Produk Terkait</h2>
            <div class="grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @forelse ($relatedProducts as $item)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300 overflow-hidden group">
                        <a href="{{ route('productDetail', $item->id) }}">
                            <div
                                class="relative w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail->image) }}"
                                        alt="{{ $item->nama }}"
                                        class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300 ease-in-out"
                                        onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-helmet-safety text-5xl opacity-30"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3
                                    class="font-semibold text-gray-800 text-lg mb-1 truncate group-hover:text-blue-700 transition">
                                    {{ $item->nama }}
                                </h3>
                                <p class="text-blue-600 font-semibold text-sm">
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Stok: {{ $item->stok }}</p>
                                <a href="{{ route('productDetail', $item->id) }}"
                                    class="mt-3 inline-block text-center w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        Produk terkait tidak ditemukan.
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const icon = this.querySelector('i');

            menu.classList.toggle('hidden');
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });
    </script>
</body>

</html>
