<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Katalog Produk</title>
    @vite(['resources/css/app.css', 'resources/js/product.js'])
</head>

<body class="bg-gray-100">
    <div class="bg-blue-600 py-4">
        <h3 class="text-white text-center text-xl font-semibold">Katalog Produk</h3>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Tambahkan tombol di bagian ini -->
        <div class="flex justify-between items-center mb-6">
            <form method="GET" action="{{ route('admin.searchProduct') }}" class="flex gap-2">
                <input type="text" name="search" placeholder="Cari produk..."
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ request()->input('search') }}" />
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Cari
                </button>
            </form>

            <div class="flex gap-2">
                <a href="{{ route('adminDashboard') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    Kembali
                </a>
                <a href="{{ route('admin.createProduct') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Tambah Produk
                </a>
            </div>
        </div>


        @if (Session::has('success'))
            <div class="mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-white text-lg font-semibold">Daftar Produk</h3>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Gambar</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Stok</th>
                            <th class="px-4 py-2">Kategori</th>
                            <th class="px-4 py-2">Dibuat</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $product->id }}</td>
                                <td class="px-4 py-2">
                                    @if ($product->gambar)
                                        <img width="50" src="{{ asset('uploads/products/' . $product->gambar) }}"
                                            alt="Product Image">
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $product->nama }}</td>
                                <td class="px-4 py-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">{{ $product->stok }}</td>
                                <td class="px-4 py-2">{{ $product->category->nama ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('admin.editProduct', $product->id) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">Edit</a>
                                    <button onclick="deleteProduct({{ $product->id }})"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Hapus</button>
                                    <form id="delete-product-form-{{ $product->id }}"
                                        action="{{ route('admin.destroyProduct', $product->id) }}" method="post"
                                        class="hidden">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Tidak ada produk ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        function deleteProduct(id) {
            if (confirm('Yakin ingin menghapus produk ini?')) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        }
    </script> --}}
</body>

</html>
