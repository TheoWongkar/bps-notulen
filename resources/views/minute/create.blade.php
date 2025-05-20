<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Script Tambahan -->
    <x-slot name="script">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    </x-slot>

    <!-- Bagian Tambah Notulen -->
    <section class="bg-white p-6 shadow-lg rounded-lg">
        <div class="border-b mb-6">
            <h2 class="text-xl font-semibold mb-2 text-black">Tambah Notulen</h2>
        </div>

        <form action="{{ route('dashboard.minute.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">

                <!-- Masalah -->
                <div>
                    <label for="problem" class="text-sm font-medium text-black">Masalah</label>
                    <textarea id="problem" name="problem" rows="4"
                        class="mt-1 p-2 w-full bg-white text-sm border border-gray-200 rounded-md shadow-sm focus:outline-black"
                        placeholder="Tuliskan masalah rapat">{{ old('problem') }}</textarea>
                    @error('problem')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Solusi -->
                <div>
                    <label for="solution" class="text-sm font-medium text-black">Solusi</label>
                    <textarea id="solution" name="solution" rows="4"
                        class="mt-1 p-2 w-full bg-white text-sm border border-gray-200 rounded-md shadow-sm focus:outline-black"
                        placeholder="Tuliskan solusi rapat">{{ old('solution') }}</textarea>
                    @error('solution')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Rencana Tindak Lanjut -->
                <div>
                    <label for="follow_up_plan" class="text-sm font-medium text-black">Rencana Tindak Lanjut</label>
                    <textarea id="follow_up_plan" name="follow_up_plan" rows="4"
                        class="mt-1 p-2 w-full bg-white text-sm border border-gray-200 rounded-md shadow-sm focus:outline-black"
                        placeholder="Tuliskan solusi rapat">{{ old('follow_up_plan') }}</textarea>
                    @error('follow_up_plan')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sumber Data -->
                <div>
                    <label for="data_source" class="text-sm font-medium text-black">Sumber Data</label>
                    <textarea id="data_source" name="data_source" rows="4"
                        class="mt-1 p-2 w-full bg-white text-sm border border-gray-200 rounded-md shadow-sm focus:outline-black"
                        placeholder="Tuliskan solusi rapat">{{ old('data_source') }}</textarea>
                    @error('data_source')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bukti Tindak Lanjut -->
                <div x-data="{ imagePreview: null }">
                    <label for="evidence" class="text-sm font-medium text-black">Bukti Tindak Lanjut</label>
                    <input id="evidence" type="file" name="evidence" accept="image/jpeg, image/png"
                        class="mt-1 w-full border border-gray-200 rounded-md shadow-sm focus:outline-black file:mr-4 file:py-2 file:px-4 file:text-sm file:bg-gray-700 file:text-white hover:file:bg-gray-800"
                        @change="imagePreview = $event.target.files.length ? URL.createObjectURL($event.target.files[0]) : null">

                    <!-- Tampilkan Preview Gambar -->
                    <div class="mt-4" x-show="imagePreview" style="display: none;">
                        <div class="overflow-auto max-w-full h-64 rounded-md border border-gray-300">
                            <img :src="imagePreview" class="w-full h-auto" alt="Image Preview">
                        </div>
                    </div>
                    @error('evidence')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col md:flex-row justify-center items-start gap-6">
                    <!-- Ditindaklanjuti oleh -->
                    <div class="w-full">
                        <label for="user_id" class="text-sm font-medium text-black">Ditindaklanjuti oleh</label>
                        <select name="user_id" id="user_id"
                            class="mt-1 p-2 w-full bg-white text-sm border border-gray-200 rounded-md shadow-sm focus:outline-black">
                            <option value="" disabled selected>Pilih Petugas</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Batas Tindak Lanjut -->
                    <div class="w-full">
                        <label for="follow_up_limits" class="text-sm font-medium text-black">Batas Tindak
                            Lanjut</label>
                        <input type="date" id="follow_up_limits" name="follow_up_limits"
                            value="{{ old('follow_up_limits') }}"
                            class="mt-1 p-2 w-full bg-white text-sm border border-gray-200 rounded-md shadow-sm focus:outline-black" />
                        @error('follow_up_limits')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('dashboard.minute.index') }}"
                        class="bg-gray-700 text-white py-2 px-6 rounded-md hover:bg-gray-800">
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
