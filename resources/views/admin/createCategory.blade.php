{{-- resources/views/admin/createCategory.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Tambah Kategori</h2>

        <form method="POST" action="{{ route('admin.storeCategory') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama Kategori</label>
                <input type="text" name="nama" class="w-full border px-3 py-2 rounded @error('nama') border-red-500 @enderror" value="{{ old('nama') }}">
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>
</body>
</html>
