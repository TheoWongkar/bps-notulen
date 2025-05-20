<!-- Header -->
<header class="flex items-center justify-between px-4 py-2 bg-white shadow">
    <!-- Judul Halaman -->
    <div class="flex items-center space-x-2">

        <!-- Tombol Toggle Sidebar untuk versi mobile -->
        <button @click="sidebarOpen = !sidebarOpen" aria-label="Tombol Sidebar" class="xl:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Judul Halaman -->
        <h2 class="text-md md:text-lg lg:text-xl font-bold">{{ $title }}</h2>
    </div>

    <!-- Profil User -->
    <div class="flex items-center space-x-1">

        <!-- Nama dan Jabatan User -->
        <div class="text-right mr-2 hidden md:block">
            <h1 class="text-sm font-bold">Username</h1>
            <p class="text-xs text-gray-800 leading-none">Role</p>
        </div>

        <!-- Gambar Profil User -->
        <img src="{{ asset('img/placeholder-profile.webp') }}" alt="Profile" class="size-12 rounded-full border-2">
    </div>
</header>
