<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .file-upload {
            position: relative;
            overflow: hidden;
        }

        .file-upload-input {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }

        .preview-container {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .preview-image {
            max-height: 150px;
            object-fit: contain;
            border-radius: 0.375rem;
            border: 1px solid #e5e7eb;
        }

        .current-image {
            max-height: 200px;
            object-fit: contain;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        @media (max-width: 640px) {
            .form-container {
                padding: 1rem;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h3 class="text-white text-xl font-semibold flex items-center gap-2">
                <i class="fas fa-edit"></i>
                <span>Edit Product</span>
            </h3>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 py-8 form-container">
        <!-- Navigation -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.listProduct') }}"
                class="flex items-center gap-2 text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Products</span>
            </a>
            <div class="text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Editing: {{ $product->nama }}
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden form-card">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h3 class="text-white text-xl font-semibold flex items-center gap-3">
                    <i class="fas fa-pencil-alt"></i>
                    <span>Update Product Details</span>
                </h3>
            </div>

            <!-- Form -->
            <form enctype="multipart/form-data" action="{{ route('admin.updateProduct', $product->id) }}" method="post"
                class="p-6 space-y-6">
                @method('put')
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-tag text-blue-500"></i>
                        <span>Product Name</span>
                    </label>
                    <input value="{{ old('nama', $product->nama) }}" type="text" name="nama"
                        placeholder="Enter product name"
                        class="w-full px-4 py-3 rounded-lg border input-field @error('nama') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Price and Stock (Row on larger screens) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-tag text-blue-500"></i>
                            <span>Price</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input value="{{ old('harga', $product->harga) }}" type="text" name="harga"
                                placeholder="0"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border input-field @error('harga') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @error('harga')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-boxes text-blue-500"></i>
                            <span>Stock</span>
                        </label>
                        <input value="{{ old('stok', $product->stok) }}" type="number" name="stok"
                            placeholder="Enter stock quantity"
                            class="w-full px-4 py-3 rounded-lg border input-field @error('stok') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('stok')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-tags text-blue-500"></i>
                        <span>Category</span>
                    </label>
                    <select name="category_id"
                        class="w-full px-4 py-3 rounded-lg border input-field @error('category_id') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-align-left text-blue-500"></i>
                        <span>Description</span>
                    </label>
                    <textarea name="deskripsi" placeholder="Enter product description" rows="5"
                        class="w-full px-4 py-3 rounded-lg border input-field border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="space-y-2">
                    {{-- <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-image text-blue-500"></i>
                        <span>Product Image</span>
                    </label> --}}

                    <!-- Current Image -->
                    {{-- @if ($product->thumbnail)
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Current Image:</p>
                            <img class="current-image"
                                src="{{ asset('uploads/products/' . $product->thumbnail->image) }}"
                                alt="Current product image">
                        </div>
                    @endif --}}

                    <!-- New Image Upload -->
                    <!-- Image Upload -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-image text-blue-500"></i>
                            <span>Product Image</span>
                        </label>

                        <!-- Current Thumbnail -->
                        @if ($product->thumbnail)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Current Thumbnail:</p>
                                <img class="current-image"
                                    src="{{ asset('uploads/products/' . $product->thumbnail->image) }}"
                                    alt="Current product image">
                            </div>
                        @endif


                        <!-- New Image Upload Input -->
                        <div class="space-y-2">
                            <label class="block text-sm text-gray-500">Upload New Images:</label>
                            <input type="file" name="images[]" multiple onchange="previewImage(this)"
                                class="w-full px-4 py-2 border rounded-lg input-field border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('images')
                                <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Preview Uploaded Images -->
                        <div id="image-preview-container" class="preview-container"></div>
                    </div>


                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition text-lg font-medium shadow-md">
                            <i class="fas fa-save"></i>
                            <span>Update Product</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
    <!-- Existing Additional Images -->
    <div class="bg-white rounded-xl shadow-md px-4 py-5 mt-2">
        @if ($product->images->count())
            <div class="mb-4">
                <p class="text-sm text-gray-500 mb-2">Gambar Tambahan yang Sudah Ada:</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($product->images as $img)
                        <div class="relative group shadow-md rounded-md overflow-hidden">
                            <div class="w-full aspect-square bg-gray-100">
                                <img src="{{ asset('uploads/products/' . $img->image) }}" alt="Gambar Produk"
                                    class="w-full h-full object-cover">
                            </div>

                            <form action="{{ route('admin.deleteImage', $img->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');"
                                class="absolute top-2 right-2 transition-opacity duration-200 sm:opacity-0 sm:group-hover:opacity-100 opacity-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-2 py-1 rounded text-xs sm:text-sm shadow hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>




    <script>
        // Image preview functionality
        function previewImage(input) {
            const previewContainer = document.getElementById('image-preview-container');
            previewContainer.innerHTML = '';

            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    const preview = document.createElement('img');
                    preview.className = 'preview-image';

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.appendChild(preview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
</body>

</html>
