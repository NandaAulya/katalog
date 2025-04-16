<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Product</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  <div class="bg-blue-600 py-4">
    <h3 class="text-white text-center text-xl font-semibold">
      Admin - Create Product
    </h3>
  </div>

  <div class="max-w-4xl mx-auto px-4 py-8">
    <div class="flex justify-end mb-4">
      <a href="{{ route('admin.listProduct') }}" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back
      </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg">
      <div class="bg-blue-600 px-6 py-4 rounded-t-lg">
        <h3 class="text-white text-lg font-semibold">Create Product</h3>
      </div>

      <form enctype="multipart/form-data" action="{{ route('admin.storeProduct') }}" method="post" class="p-6">
        @csrf

        <!-- Name -->
        <div class="mb-4">
          <label class="block text-lg font-medium mb-1">Name</label>
          <input type="text" name="nama" placeholder="Name"
            value="{{ old('nama') }}"
            class="w-full px-4 py-2 rounded border @error('nama') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          @error('nama')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Price -->
        <div class="mb-4">
          <label class="block text-lg font-medium mb-1">Price</label>
          <input type="text" name="harga" placeholder="harga"
            value="{{ old('harga') }}"
            class="w-full px-4 py-2 rounded border @error('harga') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          @error('harga')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Stock -->
        <div class="mb-4">
          <label class="block text-lg font-medium mb-1">Stock</label>
          <input type="number" name="stok" placeholder="stok"
            value="{{ old('stok') }}"
            class="w-full px-4 py-2 rounded border @error('stok') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          @error('stok')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Category -->
        <div class="mb-4">
          <label class="block text-lg font-medium mb-1">Category</label>
          <select name="category_id" class="w-full px-4 py-2 rounded border @error('category_id') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Choose Category --</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->nama }}
              </option>
            @endforeach
          </select>
          @error('category_id')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label class="block text-lg font-medium mb-1">Description</label>
          <textarea name="deskripsi" placeholder="deskripsi"
            class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            rows="5">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- Image -->
        <div class="mb-4">
          <label class="block text-lg font-medium mb-1">Image</label>
          <input type="file" name="gambar"
            class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Submit -->
        <div>
          <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition text-lg font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
