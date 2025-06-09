<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Script Tambahan -->
    <x-slot name="script">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    </x-slot>

    <!-- Bagian Ubah Notulen -->
    <!-- Bagian Edit Notulen -->
    <section class="bg-white p-6 shadow-lg rounded-lg">
        <div class="border-b mb-6">
            <h2 class="text-xl font-semibold mb-2 text-black">Edit Notulen</h2>
        </div>

        <form action="{{ route('dashboard.minute.update', $minute->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-6">

                <!-- Masalah -->
                <div>
                    <label for="problem" class="text-sm font-medium text-black">Masalah</label>
                    <input id="problem" type="hidden" name="problem">
                    <trix-editor input="problem"
                        aria-placeholder="Tuliskan masalah rapat">{!! old('problem', $minute->problem) !!}</trix-editor>
                    @error('problem')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Solusi -->
                <div>
                    <label for="solution" class="text-sm font-medium text-black">Solusi</label>
                    <input id="solution" type="hidden" name="solution">
                    <trix-editor input="solution"
                        aria-placeholder="Tuliskan masalah rapat">{!! old('solution', $minute->solution) !!}</trix-editor>
                    @error('solution')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Rencana Tindak Lanjut -->
                <div>
                    <label for="follow_up_plan" class="text-sm font-medium text-black">Rencana Tindak Lanjut</label>
                    <input id="follow_up_plan" type="hidden" name="follow_up_plan">
                    <trix-editor input="follow_up_plan"
                        aria-placeholder="Tuliskan masalah rapat">{!! old('follow_up_plan', $minute->follow_up_plan) !!}</trix-editor>
                    @error('follow_up_plan')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sumber Data -->
                <div>
                    <label for="data_source" class="text-sm font-medium text-black">Sumber Data</label>
                    <input id="data_source" type="hidden" name="data_source">
                    <trix-editor input="data_source"
                        aria-placeholder="Tuliskan masalah rapat">{!! old('data_source', $minute->data_source) !!}</trix-editor>
                    @error('data_source')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bukti Tindak Lanjut -->
                <div x-data="{ imagePreview: '{{ $minute->evidence ? asset('storage/' . $minute->evidence) : null }}' }">
                    <label for="evidence" class="text-sm font-medium text-black">File Lampiran</label>
                    <input id="evidence" type="file" name="evidence" accept="image/jpeg, image/png"
                        class="mt-1 w-full border border-gray-200 rounded-md shadow-sm focus:outline-black file:mr-4 file:py-2 file:px-4 file:text-sm file:bg-gray-700 file:text-white hover:file:bg-gray-800"
                        @change="imagePreview = $event.target.files.length ? URL.createObjectURL($event.target.files[0]) : imagePreview">

                    <!-- Tampilkan Preview Gambar -->
                    <div class="mt-4" x-show="imagePreview">
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
                            <option value="" disabled>Pilih Petugas</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $minute->user_id) == $user->id ? 'selected' : '' }}>
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
                            value="{{ old('follow_up_limits', $minute->follow_up_limits ? $minute->follow_up_limits : '') }}"
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
                        Perbarui
                    </button>
                </div>
            </div>
        </form>
    </section>

</x-app-layout>
