<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Bagian Pengguna -->
    <section class="bg-white p-6 shadow-lg rounded-lg">
        <!-- Form Pencarian dan Filter -->
        <div class="flex justify-end items-center mb-4 gap-2">
            <form action="#" method="GET" class="w-full md:w-auto">
                <div x-data="{ showModal: false }" class="relative flex items-center w-full">

                    <!-- Tombol Filter -->
                    <button type="button" @click="showModal = true" aria-label="Tombol Filter"
                        class="bg-gray-800 hover:bg-gray-700 text-white border border-gray-800 rounded-l-full px-4 py-2 transition duration-200">
                        Filter
                    </button>

                    <!-- Input Pencarian -->
                    <input type="text" name="search" value="{{ $search }}"
                        class="w-full md:w-64 px-4 py-2 border-y focus:outline-none focus:bg-blue-50"
                        placeholder="Cari pegawai..." autocomplete="off" autofocus />

                    <!-- Tombol Submit -->
                    <button type="submit" aria-label="Tombol Cari"
                        class="bg-gray-800 hover:bg-gray-700 text-white border border-gray-800 rounded-r-full px-4 py-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    <!-- Modal Filter -->
                    <div x-cloak x-show="showModal"
                        class="fixed inset-0 bg-black/80 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-72 md:w-96">
                            <h2 class="text-lg font-semibold mb-4">Filter Tanggal</h2>
                            <div class="mb-4">
                                <label for="start_date" class="block text-sm font-medium">Tanggal Awal</label>
                                <input type="date" name="start_date" id="start_date" value="{{ $start_date }}"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300">
                            </div>
                            <div class="mb-4">
                                <label for="end_date" class="block text-sm font-medium">Tanggal Akhir</label>
                                <input type="date" name="end_date" id="end_date" value="{{ $end_date }}"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300">
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="showModal = false"
                                    class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-800">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pesan Status -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-500 text-green-800 px-4 py-3 rounded relative mb-3">
                {{ session('success') }}</div>
        @elseif (session('error'))
            <div class="bg-red-100 border border-red-500 text-red-800 px-4 py-3 rounded relative mb-3">
                {{ session('error') }}</div>
        @endif

        <!-- Tabel Pengguna -->
        <div class="overflow-x-auto rounded-md shadow-md">
            <table class="min-w-full bg-gray-100">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-center py-3 px-2 text-sm font-semibold uppercase">#</th>
                        <th class="text-left py-3 px-2 text-sm font-semibold uppercase">Nama</th>
                        <th class="text-left py-3 px-2 text-sm font-semibold uppercase">Email</th>
                        <th class="text-center py-3 px-2 text-sm font-semibold uppercase">Peran</th>
                        <th class="text-center py-3 px-2 text-sm font-semibold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-t hover:bg-blue-100 transition duration-200">
                            <td class="py-3 px-2 text-center text-sm">{{ $loop->iteration }}</td>
                            <td class="py-3 px-2 text-sm">{{ $user->name }}</td>
                            <td class="py-3 px-2 text-sm">{{ $user->email }}</td>
                            <td class="py-3 px-2 text-center text-sm">{{ $user->role }}</td>
                            <td class="py-3 px-2 flex justify-center items-center gap-1">
                                <a href="{{ route('dashboard.user.edit', $user->id) }}" aria-label="Edit Pengguna"
                                    class="bg-yellow-600 hover:bg-yellow-500 text-white p-1 rounded-md text-xs shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('dashboard.user.destroy', $user->id) }}" method="POST"
                                    class="flex items-center"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna?');">
                                    @csrf
                                    @method('DELETE')
                                    <button aria-label="Hapus Pengguna"
                                        class="bg-red-600 hover:bg-red-500 text-white p-1 rounded-md text-xs shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <h3 class="font-medium text-red-500">Pengguna tidak ditemukan</h3>
                                <p class="text-sm text-gray-500">Silakan cek kembali nanti!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </section>

</x-app-layout>
