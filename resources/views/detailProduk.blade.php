<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama }} | UMKM Agus Jaya</title>
    @vite('resources/css/app.css', 'resources/js/detailProducts.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-image-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
        }
        
        .price-tag {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .whatsapp-btn {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(25, 175, 80, 0.3);
            background: linear-gradient(to right, #25D366, #128C7E);
        }
        
        .whatsapp-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(25, 175, 80, 0.4);
        }
        
        .back-btn {
            transition: all 0.2s ease;
        }
        
        .back-btn:hover {
            transform: translateX(-3px);
        }
        
        .stock-badge {
            position: relative;
            overflow: hidden;
        }
        
        .stock-badge::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .stock-badge:hover::after {
            transform: translateX(0);
        }
        
        @media (min-width: 768px) {
            .product-container {
                max-width: 800px;
            }
            
            .product-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 min-h-screen">
    <!-- Navbar (optional) -->
    <x-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <div class="product-container mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Product Grid -->
            <div class="product-grid">
                <!-- Gambar Produk -->
                <div class="product-image-container h-full min-h-96 flex items-center justify-center p-8 relative">
                    @if($product->gambar)
                        <img src="{{ asset('uploads/products/' . $product->gambar) }}" 
                             alt="{{ $product->nama }}"
                             class="h-full max-h-80 w-auto object-contain transition duration-500 hover:scale-105"
                             onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
                    @else
                        <div class="text-center text-gray-400">
                            <i class="fas fa-helmet-safety text-6xl opacity-30"></i>
                            <p class="mt-4 text-sm font-medium">Gambar tidak tersedia</p>
                        </div>
                    @endif
                    
                    <!-- Badge untuk produk baru -->
                    @if($product->is_new)
                    <div class="absolute top-4 right-4 bg-amber-500 text-white font-bold px-3 py-1 rounded-full text-xs flex items-center animate-pulse">
                        <i class="fas fa-certificate mr-1"></i> BARU
                    </div>
                    @endif
                </div>
                
                <!-- Detail Produk -->
                <div class="p-8 flex flex-col">
                    <!-- Nama Produk -->
                    <h1 class="text-2xl md:text-3xl font-bold mb-3 text-gray-900">{{ $product->nama }}</h1>
                    
                    <!-- Kategori -->
                    <div class="mb-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            <i class="fas fa-tag mr-1"></i> {{ $product->category->nama ?? 'Uncategorized' }}
                        </span>
                    </div>
                    
                    <!-- Rating (jika ada) -->
                    @if($product->rating)
                    <div class="flex items-center mb-4">
                        <div class="flex text-amber-400 mr-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating))
                                    <i class="fas fa-star"></i>
                                @elseif($i - 0.5 <= $product->rating)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">({{ $product->review_count ?? 0 }} ulasan)</span>
                    </div>
                    @endif
                    
                    <!-- Harga dan Stok -->
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-3xl font-extrabold price-tag">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </span>
                        <span class="stock-badge bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                            <i class="fas fa-box-open mr-1"></i> Stok: {{ $product->stok }}
                        </span>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="mb-8 flex-grow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3 border-b pb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->deskripsi ?? 'Tidak ada deskripsi tersedia' }}</p>
                    </div>
                    
                    <!-- Tombol WhatsApp -->
                    <div class="mt-auto">
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20produk%20{{ urlencode($product->nama) }}%20(%20Rp%20{{ number_format($product->harga, 0, ',', '.') }})%20di%20UMKM%20Agus%20Jaya"
                           class="whatsapp-btn w-full text-white py-4 px-6 rounded-lg flex items-center justify-center font-bold text-lg">
                            <i class="fab fa-whatsapp text-2xl mr-3"></i> BELI VIA WHATSAPP
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-8 text-center">
            <a href="{{ route('katalog') }}" 
               class="back-btn inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</body>
</html>