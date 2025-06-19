<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Product - Admin</title>
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
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
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
            padding: 1rem;
            border: 2px dashed #d1d5db;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }

        .preview-image {
            max-height: 200px;
            object-fit: contain;
            margin-top: 1rem;
            border-radius: 0.375rem;
            display: none;
        }

        @media (max-width: 640px) {
            .form-container {
                padding: 1rem;
            }

            .form-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h3 class="text-white text-xl font-semibold flex items-center gap-2">
                <i class="fas fa-cube"></i>
                <span>Create New Product</span>
            </h3>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8 form-container">
        <!-- Navigation -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.listProduct') }}"
                class="flex items-center gap-2 text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Products</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden form-card">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h3 class="text-white text-xl font-semibold flex items-center gap-3">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add New Product</span>
                </h3>
            </div>

            <!-- Form -->
            <form enctype="multipart/form-data" action="{{ route('admin.storeProduct') }}" method="post"
                class="p-6 space-y-6">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-tag text-blue-500"></i>
                        <span>Product Name</span>
                    </label>
                    <input type="text" name="nama" placeholder="Enter product name" value="{{ old('nama') }}"
                        class="w-full px-4 py-3 rounded-lg border input-field @error('nama') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500" />
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
                            <input type="text" name="harga" placeholder="0" value="{{ old('harga') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border input-field @error('harga') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500" />
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
                        <input type="number" name="stok" placeholder="Enter stock quantity"
                            value="{{ old('stok') }}"
                            class="w-full px-4 py-3 rounded-lg border input-field @error('stok') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500" />
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
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    <textarea name="deskripsi" placeholder="Enter product description"
                        class="w-full px-4 py-3 rounded-lg border input-field border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="5">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Image Upload -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-image text-blue-500"></i>
                        <span>Product Image</span>
                    </label>
                    <div class="file-upload">
                        <input type="file" name="gambar[]" id="gambar" class="file-upload-input"
                            onchange="previewMultipleImages(event)" multiple>
                        <label for="gambar" class="file-upload-label flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <span class="text-gray-600">Click to upload product image</span>
                            <span class="text-sm text-gray-400">(JPEG, PNG, max 2MB)</span>
                        </label>
                        <!-- Preview container -->
                        <div id="image-preview-container" class="flex gap-4 flex-wrap mt-4"></div>

                        <img id="image-preview" class="preview-image" alt="Preview">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition text-lg font-medium shadow-md">
                        <i class="fas fa-save"></i>
                        <span>Save Product</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewMultipleImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('image-preview-container');
            previewContainer.innerHTML = ''; // Kosongkan container sebelumnya

            if (files && files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Hanya proses file gambar
                    if (!file.type.startsWith('image/')) continue;

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-32 h-32 object-cover rounded shadow-md border border-gray-200';
                        previewContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                }
            }
        }

        // Format price input
        // document.querySelector('input[name="harga"]').addEventListener('input', function(e) {
        //   let value = e.target.value.replace(/\D/g, '');
        //   e.target.value = formatNumber(value);
        // });

        // function formatNumber(number) {
        //   return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        // }
    </script>
</body>

</html>
