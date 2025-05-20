<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Metadata -->
    <meta name="description" content="Website Badan Pusat Statistika, Sulawesi Utara.">
    <meta name="keywords" content="BPS Sulut, sistem notulen online">
    <meta name="author" content="BPS Sulut">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/application-logo.svg') }}" type="image/x-icon">

    <!-- Judul Halaman -->
    <title>BPS | {{ $title }}</title>

    <!-- Framework Frontend -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script Tambahan -->
    @isset($script)
        {{ $script }}
    @endisset

    <!-- Default CSS -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased">

    <div class="flex flex-col min-h-screen">
        <!-- Layout Utama -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
