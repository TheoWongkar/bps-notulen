<!-- Header -->
<header class="flex items-center justify-between px-4 py-3 bg-white shadow-md sticky top-0 z-50">
    <!-- Kiri: Toggle + Judul -->
    <div class="flex items-center space-x-3">
        <!-- Tombol Toggle Sidebar untuk mobile -->
        <button @click="sidebarOpen = !sidebarOpen" aria-label="Toggle Sidebar"
            class="xl:hidden text-gray-700 hover:text-blue-600 focus:outline-none transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Judul Halaman -->
        <h2 class="text-lg md:text-xl font-semibold text-gray-800">{{ $title }}</h2>
    </div>

    <!-- Kanan: Profil User -->
    <div class="flex items-center space-x-3">
        <!-- Info User -->
        <div class="hidden md:flex flex-col text-right leading-tight">
            <span class="font-semibold text-sm text-gray-800">Username</span>
            <span class="text-xs text-gray-500">Role</span>
        </div>

        <!-- Foto Profil -->
        <img src="{{ asset('img/placeholder-profile.webp') }}" alt="Foto Profil"
            class="w-10 h-10 rounded-full border-2 border-gray-300 shadow-sm object-cover">
    </div>
</header>
