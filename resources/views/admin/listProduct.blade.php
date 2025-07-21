<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Katalog Produk - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/product.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-in-stock {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-out-of-stock {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .action-btn {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .search-box {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .responsive-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .search-container {
                flex-direction: column;
                gap: 0.75rem;
            }

            .search-box {
                width: 100%;
            }

            .action-buttons {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-blue-600 py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h3 class="text-white text-xl font-semibold flex items-center gap-2">
                <i class="fas fa-boxes"></i>
                <span>Katalog Produk</span>
            </h3>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Search and Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.searchProduct') }}"
                class="w-full md:w-auto search-container flex gap-2 items-center">
                <div class="relative flex-grow search-box">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" placeholder="Cari produk..."
                        class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ request()->input('search') }}" />
                </div>

                <select name="category"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 search-box">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2 search-box">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
            </form>

            <div class="flex gap-2 w-full md:w-auto action-buttons">
                <a href="{{ route('adminDashboard') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <a href="{{ route('admin.createProduct') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (Session::has('success'))
            <div class="mb-6">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Product Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                <h3 class="text-white text-lg font-semibold flex items-center gap-2">
                    <i class="fas fa-list"></i>
                    <span>Daftar Produk</span>
                </h3>
                <p class="text-white text-sm">
                    Total: {{ $products->total() }} produk
                </p>
            </div>

            <div class="p-6">
                <div class="responsive-table">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gambar</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stok</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dibuat</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $product->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail->image) }}"
                                                alt="{{ $product->nama }}" class="product-image"
                                                onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="fas fa-helmet-safety text-5xl opacity-30"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        {{ $product->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->stok > 0)
                                            <span class="badge badge-in-stock">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ $product->stok }} pcs
                                            </span>
                                        @else
                                            <span class="badge badge-out-of-stock">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                            {{ $product->category->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($product->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.editProduct', $product->id) }}"
                                                class="action-btn bg-yellow-400 text-white hover:bg-yellow-500">
                                                <i class="fas fa-edit"></i>
                                                <span class="hidden md:inline">Edit</span>
                                            </a>
                                            <button onclick="confirmDelete({{ $product->id }})"
                                                class="action-btn bg-red-600 text-white hover:bg-red-700">
                                                <i class="fas fa-trash"></i>
                                                <span class="hidden md:inline">Hapus</span>
                                            </button>
                                            <form id="delete-product-form-{{ $product->id }}"
                                                action="{{ route('admin.destroyProduct', $product->id) }}"
                                                method="post" class="hidden">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <i class="fas fa-box-open text-4xl text-gray-300 mb-2"></i>
                                            <p class="text-lg">Tidak ada produk ditemukan</p>
                                            <a href="{{ route('admin.createProduct') }}"
                                                class="text-blue-600 hover:underline mt-2">
                                                Tambah produk pertama Anda
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($products->hasPages())
                    <div class="mt-6">
                        {{ $products->withQueryString()->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-lg relative">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 absolute top-4 right-4">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-gray-600 mb-6">Anda yakin ingin menghapus produk ini?</p>
            <div class="flex justify-end gap-3">
                <button onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Batal
                </button>
                <button id="confirm-delete-btn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>


    <script>
        let productIdToDelete = null;

        function confirmDelete(id) {
            productIdToDelete = id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (productIdToDelete) {
                document.getElementById('delete-product-form-' + productIdToDelete).submit();
            }
        });
    </script>
</body>

</html>
