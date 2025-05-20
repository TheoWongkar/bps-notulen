<!-- Sidebar Overlay -->
<div x-show="sidebarOpen" class="fixed inset-0 z-20 xl:hidden" style="background: rgba(0, 0, 0, 0.842);"
    @click="sidebarOpen = false">
</div>

<!-- Sidebar -->
<aside
    class="fixed inset-y-0 z-30 w-64 bg-blue-950 shadow-md xl:static xl:shadow-none xl:translate-x-0 transform transition-transform duration-300"
    :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

    <!-- Logo dan Judul -->
    <div class="px-6 py-4 flex items-center gap-2">
        <img src="{{ asset('img/application-logo.svg') }}" alt="Logo BPS Sulut" class="w-12 h-12">
        <div>
            <h1 class="text-sm font-semibold text-white leading-none">
                Badan Pusat Statistika <span class="block text-sm font-medium text-gray-300 leading-none">Sulawesi
                    Utara</span>
            </h1>
        </div>
    </div>

    <!-- Navigasi Utama -->
    <nav class="flex-1 p-4 space-y-2 font-light">

        <!-- Menu Utama -->
        <div>
            <h2 class="px-2 py-1 font-medium text-gray-400">Menu</h2>

            <!-- Dashboard -->
            <a href="#"
                class="{{ Request::routeIs('dashboard') ? 'animate-pulse' : 'animate-none' }} flex gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                </svg>
                <span class="inline">Dashboard</span>
            </a>

        </div>

        <!-- Notulen -->
        <div>
            <h2 class="px-2 py-1 font-medium text-gray-400">Notulen</h2>

            <!-- List Notulen -->
            <a href="#"
                class="{{ Request::routeIs('#') ? 'animate-pulse' : 'animate-none' }} flex gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
                <span class="inline">List Notulen</span>
            </a>

            <!-- Tambah Notulen -->
            <a href="#"
                class="{{ Request::routeIs('#') ? 'animate-pulse' : 'animate-none' }} flex gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
                <span>Tambah Notulen</span>
            </a>
        </div>

        <!-- Lainnya -->
        <div>
            <h2 class="px-2 py-1 font-medium text-gray-400">Lainnya</h2>

            <!-- Logout Button -->
            <form action="#" method="POST">
                @csrf
                <button class="flex w-full gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
