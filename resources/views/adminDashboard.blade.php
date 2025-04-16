<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">Admin Panel</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main layout: Sidebar + Content -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-6">
            <nav class="flex flex-col gap-4">
                <a href="{{ route('adminDashboard') }}" class="text-lg font-medium text-blue-600 hover:underline">Dashboard</a>
                <a href="{{ route('admin.listProduct') }}" class="text-gray-700 hover:text-blue-600">List Produk</a>
                <a href="{{ route('admin.listCategory') }}" class="text-gray-700 hover:text-blue-600">Kategori</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            <h2 class="text-2xl font-semibold mb-4">Selamat Datang di Halaman Admin</h2>
            <p class="text-gray-600">Silakan pilih menu dari sidebar untuk mengelola data.</p>
        </main>

    </div>

</body>
</html>
