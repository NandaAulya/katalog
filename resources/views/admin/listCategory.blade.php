{{-- resources/views/admin/listCategory.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
    @vite(['resources/css/app.css', 'resources/js/category.js'])
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow p-6 rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('adminDashboard') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            <h2 class="text-xl font-bold">Daftar Kategori</h2>
            <a href="{{ route('admin.createCategory') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif


        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Created At</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $category->id }}</td>
                        <td class="px-4 py-2">{{ $category->nama }}</td>
                        <td class="px-4 py-2">{{ $category->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            <button onclick="deleteCategory({{ $category->id }})"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                Hapus
                            </button>
                            <form id="delete-category-form-{{ $category->id }}"
                                action="{{ route('admin.destroyCategory', $category->id) }}" method="POST"
                                class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Belum ada kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    {{-- <script>
        function deleteCategory(id) {
            if (confirm('Yakin ingin menghapus kategori ini?')) {
                document.getElementById('delete-category-form-' + id).submit();
            }
        }
    </script> --}}
</body>

</html>
