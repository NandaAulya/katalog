<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Agus Jaya</title>
    @vite('resources/css/app.css')
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        .slick-prev:before,
        .slick-next:before {
            color: #3b82f6;
            /* Warna biru sesuai tema */
            font-size: 24px;
        }

        .slick-dots li button:before {
            font-size: 12px;
            color: #3b82f6;
        }

        .slick-dots li.slick-active button:before {
            color: #3b82f6;
        }

        .promo-slide {
            padding: 0 10px;
        }

        .promo-slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="mb-16">
            <div class="promo-slider">
                <!-- Slide 1 -->
                <div class="promo-slide relative">
                    <img src="images/image1.jpg" alt="Promo Helm 1">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
                        <div class="max-w-md">
                            <h3 class="text-white text-2xl font-bold mb-2">DISKON 30% HARI INI!</h3>
                            <p class="text-gray-200 mb-4">Khusus pembelian helm seri terbaru dengan kupon HELM2023</p>
                            <a href="#"
                                class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-bold py-2 px-6 rounded-lg inline-block">BELI
                                SEKARANG</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="promo-slide relative">
                    <img src="images/image2.jpg" alt="Promo Helm 2">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
                        <div class="max-w-md">
                            <h3 class="text-white text-2xl font-bold mb-2">GRATIS AKSESORI!</h3>
                            <p class="text-gray-200 mb-4">Dapatkan masker dan sarung tangan gratis untuk pembelian di
                                atas Rp 1.500.000</p>
                            <a href="#"
                                class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-bold py-2 px-6 rounded-lg inline-block">LIHAT
                                PRODUK</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="promo-slide relative">
                    <img src="images/image3.jpeg" alt="Promo Helm 3">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
                        <div class="max-w-md">
                            <h3 class="text-white text-2xl font-bold mb-2">HELM LIMITED EDITION</h3>
                            <p class="text-gray-200 mb-4">Koleksi helm edisi terbatas dengan desain eksklusif</p>
                            <a href="#"
                                class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-bold py-2 px-6 rounded-lg inline-block">PESAN
                                SEKARANG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Promo Section -->
        <div class="bg-blue-50 rounded-xl p-8 mb-12">
            <h2 class="text-2xl font-bold mb-6 text-center">Promo Spesial Bulan Ini</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Promo 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="bg-red-600 text-white py-2 text-center font-bold">
                        HOT DEAL
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Diskon 25% Helm Sport</h3>
                        <p class="text-gray-600 mb-3">Khusus untuk seri helm sport terbaru. Berlaku hingga 30 November
                            2023.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Kode: <span class="font-bold">HELMSPORT25</span></span>
                            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>

                <!-- Promo 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="bg-green-600 text-white py-2 text-center font-bold">
                        BUNDLING
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Beli 2 Helm Gratis 1 Jaket</h3>
                        <p class="text-gray-600 mb-3">Dapatkan jaket riding senilai Rp 350.000 dengan pembelian 2 helm.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Jaket limited stock</span>
                            <a href="#" class="text-blue-600 hover:underline">Lihat Katalog</a>
                        </div>
                    </div>
                </div>

                <!-- Promo 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="bg-yellow-500 text-white py-2 text-center font-bold">
                        CASHBACK
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Cashback 10% OVO/GoPay</h3>
                        <p class="text-gray-600 mb-3">Pembayaran via OVO/GoPay dapat cashback maksimal Rp 100.000.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Min. transaksi Rp 500.000</span>
                            <a href="#" class="text-blue-600 hover:underline">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten lainnya tetap sama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Feature boxes... -->
        </div>

        <!-- About Us Section -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-12">
            <h2 class="text-2xl font-bold mb-6 text-center">Tentang UMKM Helm</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1601362840469-51e4d8d58785?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        alt="Toko UMKM Helm" class="w-full rounded-lg shadow-md">
                </div>
                <div>
                    <p class="text-gray-600 mb-4">
                        <span class="font-semibold text-blue-600">UMKM Helm</span> berdiri sejak 2010 dengan komitmen
                        menyediakan helm berkualitas tinggi dengan harga terjangkau.
                        Kami adalah usaha keluarga yang telah berkembang menjadi penyedia perlengkapan keselamatan
                        berkendara terpercaya.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Semua produk kami telah memenuhi standar <span class="font-semibold">SNI (Standar Nasional
                            Indonesia)</span> dan beberapa bahkan telah mendapatkan sertifikasi
                        internasional seperti <span class="font-semibold">DOT (Department of Transportation)</span> dan
                        <span class="font-semibold">ECE (Economic Commission for Europe)</span>.
                    </p>
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Jl. Raya Keselamatan No. 123, Jakarta Selatan</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>(021) 1234-5678 | 0812-3456-7890</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer (tetap sama) -->
    <x-footer />


    <!-- jQuery dan Slick Carousel JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.promo-slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false
                    }
                }]
            });
        });
    </script>
</body>

</html>
