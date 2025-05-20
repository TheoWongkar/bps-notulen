<!-- Sidebar Overlay -->
<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 xl:hidden bg-black/80"
    @click="sidebarOpen = false">
</div>

<!-- Sidebar -->
<aside
    class="fixed inset-y-0 z-30 w-64 bg-blue-950 text-white shadow-lg transform transition-transform duration-300 ease-in-out xl:static xl:translate-x-0 xl:shadow-none"
    :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

    <!-- Logo dan Judul -->
    <div class="px-6 py-5 flex items-center gap-3 border-b border-white/10">
        <img src="{{ asset('img/application-logo.svg') }}" alt="Logo BPS Sulut" class="w-10 h-10">
        <div>
            <h1 class="text-base font-semibold leading-tight">
                Badan Pusat Statistik
                <span class="block text-sm font-normal text-gray-300">Sulawesi Utara</span>
            </h1>
        </div>
    </div>

    <!-- Navigasi Utama -->
    <nav class="flex-1 p-4 space-y-6 text-sm font-medium overflow-y-auto">

        <!-- Menu Utama -->
        <div>
            <h2 class="px-2 text-xs uppercase tracking-wide text-gray-400 mb-2">Menu</h2>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-white/10 {{ Request::routeIs('dashboard') ? 'bg-white/10 text-white font-semibold' : 'text-white/80' }}">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Notulen -->
        <div>
            <h2 class="px-2 text-xs uppercase tracking-wide text-gray-400 mb-2">Notulen</h2>

            <a href="{{ route('dashboard.minute.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-white/10 {{ Request::routeIs('#') ? 'bg-white/10 text-white font-semibold' : 'text-white/80' }}">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
                <span>List Notulen</span>
            </a>

            <a href="{{ route('dashboard.minute.create') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-white/10 {{ Request::routeIs('#') ? 'bg-white/10 text-white font-semibold' : 'text-white/80' }}">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
                <span>Tambah Notulen</span>
            </a>
        </div>

        <!-- Lainnya -->
        <div>
            <h2 class="px-2 text-xs uppercase tracking-wide text-gray-400 mb-2">Lainnya</h2>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center w-full gap-3 px-4 py-2 rounded-lg transition hover:bg-white/10 text-white/80 hover:text-white">
                    <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
