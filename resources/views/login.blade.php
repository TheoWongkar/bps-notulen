<x-guest-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Bagian Login -->
    <div class="min-h-screen bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('img/hero-img.webp') }}')">
        <div class="flex items-center justify-center min-h-screen bg-blue-950/88 px-4">
            <div class="w-full max-w-sm bg-white/20 backdrop-blur-sm p-8 rounded-2xl shadow-lg border border-white/20">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white">Badan Pusat Statistik</h2>
                    <p class="text-white/80 text-sm mt-1">Provinsi Sulawesi Utara</p>
                </div>

                <!-- Form Login -->
                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-white/80 text-sm mb-1">Email</label>
                        <input type="email" name="email"
                            class="w-full p-2 text-sm rounded-lg bg-white/90 text-gray-900 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-700">

                        @error('email')
                            <p class="mt-1 text-sm font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-white/80 text-sm mb-1">Password</label>
                        <input type="password" name="password"
                            class="w-full p-2 text-sm rounded-lg bg-white/90 text-gray-900 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-700">
                    </div>

                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-lg transition duration-300 ease-in-out shadow-md">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
