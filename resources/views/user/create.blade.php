<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Bagian Tambah Pengguna -->
    <section class="bg-white p-6 shadow-lg rounded-lg">
        <div class="border-b mb-6">
            <h2 class="text-xl font-semibold mb-2 text-black">Tambah Pengguna</h2>
        </div>

        <form action="{{ route('dashboard.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">

                <!-- Avatar Upload -->
                <div x-data="{
                    preview: null,
                    fileChosen(event) {
                        const file = event.target.files[0];
                        if (!file) return;
                        const reader = new FileReader();
                        reader.onload = (e) => this.preview = e.target.result;
                        reader.readAsDataURL(file);
                    }
                }" class="mb-4">

                    <label for="avatar" class="text-sm font-medium text-black block mb-2">Avatar</label>

                    <div class="flex items-center space-x-4">
                        <!-- Preview Box -->
                        <div
                            class="w-24 h-24 rounded-full border border-gray-300 shadow-md overflow-hidden bg-gray-100 flex items-center justify-center">
                            <template x-if="preview">
                                <img :src="preview" class="object-cover w-full h-full" alt="Avatar Preview">
                            </template>
                            <template x-if="!preview">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4.992 4.992 0 011 13c0-1.657.672-3.156 1.757-4.243M15 3h4a2 2 0 012 2v4m-4 0l-6 6M7 17h.01M17 17h.01M13 21h.01M3 21h.01" />
                                </svg>
                            </template>
                        </div>

                        <!-- File Input -->
                        <input id="avatar" name="avatar" type="file" accept="image/*" @change="fileChosen"
                            class="text-sm block w-full file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-50 file:text-blue-700
                      hover:file:bg-blue-100" />
                    </div>

                    @error('avatar')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama -->
                <div>
                    <label for="name" class="text-sm font-medium text-black">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="p-1 block w-full border border-gray-300 rounded-sm shadow-md text-sm">
                    @error('name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="text-sm font-medium text-black">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="p-1 block w-full border border-gray-300 rounded-sm shadow-md text-sm">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="text-sm font-medium text-black">Role</label>
                    <select name="role" id="role"
                        class="block p-1 w-full border border-gray-300 rounded-sm shadow-md text-sm">
                        <option value="Notulis" {{ old('role') == 'Notulis' ? 'selected' : '' }}>Notulis</option>
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col md:flex-row justify-center items-start gap-6">
                    <!-- Password -->
                    <div class="w-full">
                        <label for="password" class="text-sm font-medium text-black">Password</label>
                        <input id="password" type="password" name="password"
                            class="p-1 block w-full border border-gray-300 rounded-sm shadow-md text-sm">
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="w-full">
                        <label for="password_confirmation" class="text-sm font-medium text-black">Konfirmasi
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="p-1 block w-full border border-gray-300 rounded-sm shadow-md text-sm">
                        @error('password_confirmation')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-2 mt-4">
                    <a href="#" class="bg-gray-700 text-white py-2 px-6 rounded-md hover:bg-gray-800">
                        Batal
                    </a>
                    <button type="submit" class="bg-green-700 text-white py-2 px-6 rounded-md hover:bg-green-800">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </section>

</x-app-layout>
