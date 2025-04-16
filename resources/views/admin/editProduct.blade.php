<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="bg-blue-600 py-4">
        <h3 class="text-white text-center text-xl font-semibold">
            Update Product
        </h3>
    </div>

    <div class="max-w-5xl mx-auto px-4 mt-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.listProduct') }}"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Back
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-white text-lg font-semibold">Edit Product</h3>
            </div>

            <form enctype="multipart/form-data" action="{{ route('admin.updateProduct', $product->id) }}" method="post"
                class="p-6">
                @method('put')
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Name</label>
                    <input value="{{ old('nama', $product->nama) }}" type="text" name="nama" placeholder="Name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nama') border-red-500 @enderror">
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Stock</label>
                    <input value="{{ old('stok', $product->stok) }}" type="number" name="stok" placeholder="Stock"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('stok') border-red-500 @enderror">
                    @error('stok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category_id"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('category_id') border-red-500 @enderror">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Price</label>
                    <input value="{{ old('harga', $product->harga) }}" type="number" name="harga" placeholder="Price"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('harga') border-red-500 @enderror">
                    @error('harga')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="deskripsi" placeholder="Description" rows="5"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Image</label>
                    <input type="file" name="gambar"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @if ($product->gambar)
                    <img class="w-40 mt-3 rounded" src="{{ asset('uploads/products/' . $product->gambar) }}" alt="Product image">
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
