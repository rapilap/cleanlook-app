<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-primary text-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo dan Nama -->
        <div class="flex items-center">
            <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full mr-2">
            <span class="ml-3 text-xl font-medium">CleanLook</span>
        </div>

        <!-- Menu -->
        <div class="hidden md:flex space-x-4 text-white">
            <a href="#" class="hover:text-secondary">Dashboard</a>
            <a href="#" class="hover:text-secondary">Daftar Akun</a>
            <a href="#" class="hover:text-secondary">Logout</a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-100">
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Dashboard</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Daftar Akun</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Logout</a>
    </div>
</nav>

<script>
    // Toggle untuk mobile menu
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
