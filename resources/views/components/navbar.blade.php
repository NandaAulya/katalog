<nav class="bg-blue-600 p-4 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-helmet-safety text-white text-2xl mr-2"></i>
            <h1 class="text-white text-xl font-bold">Toko Agus Jaya</h1>
        </div>
        <div class="hidden md:flex gap-6 items-center">
            <a href="{{ route('dashboard') }}" class="nav-link text-white hover:text-white">Dashboard</a>
            <a href="{{ route('katalog') }}" class="nav-link active text-white font-semibold">Katalog</a>

            @auth
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-white">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-blue-100 hover:text-white transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                    Login
                </a>
            @endguest
        </div>

        <!-- Mobile menu button -->
        <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden hidden bg-blue-700 px-4 py-2" id="mobile-menu">
        <div class="flex flex-col space-y-3">
            <a href="{{ route('dashboard') }}" class="text-white py-2 border-b border-blue-600">Dashboard</a>
            <a href="{{ route('katalog') }}" class="text-white font-semibold py-2 border-b border-blue-600">Katalog</a>

            @auth
                <div class="flex items-center justify-between py-2 border-b border-blue-600">
                    <span class="text-white">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-200 hover:text-white">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium text-center">
                    Login
                </a>
            @endguest
        </div>
    </div>
</nav>
