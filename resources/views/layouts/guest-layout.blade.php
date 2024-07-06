<!doctype html>
<html lang="en">

<head>
    <title>
        {{ $title ?? 'Thrive Blog Competition 2024' }} - Perusahaan IT Terbaik Sejak 2007 di Indonesia
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="title" content="Thrive Blog Competition 2024 - Perusahaan IT Terbaik Sejak 2007 di Indonesia">
    <meta name="description"
        content="Ikuti Thrive Blog Competition 2024 dan menangkan berbagai hadiah menarik. Temukan berbagai solusi dan produk IT untuk beragam kebutuhan bisnis dan perusahaan bersama Thrive!">
    <meta name="keywords"
        content="Thrive, Blog Competition 2024, perusahaan IT, solusi IT, produk IT, bisnis, teknologi, Indonesia">
    <meta name="author" content="Thrive">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Thrive Blog Competition 2024 - Perusahaan IT Terbaik Sejak 2007 di Indonesia">
    <meta property="og:description"
        content="Ikuti Thrive Blog Competition 2024 dan menangkan berbagai hadiah menarik. Temukan berbagai solusi dan produk IT untuk beragam kebutuhan bisnis dan perusahaan bersama Thrive!">
    <meta property="og:image" content="https://www.thrive.co.id/images/logo-thrive.png">
    <meta property="og:url" content="https://www.thrive.co.id">
    <meta property="og:site_name" content="Thrive">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Thrive Blog Competition 2024 - Perusahaan IT Terbaik Sejak 2007 di Indonesia">
    <meta name="twitter:description"
        content="Ikuti Thrive Blog Competition 2024 dan menangkan berbagai hadiah menarik. Temukan berbagai solusi dan produk IT untuk beragam kebutuhan bisnis dan perusahaan bersama Thrive!">
    <meta name="twitter:image" content="https://www.thrive.co.id/images/logo-thrive.png">
    <meta name="twitter:url" content="https://www.thrive.co.id">
    <meta name="twitter:site" content="@Thrive">

    <link rel="shortcut icon" type="image/png" href="https://www.thrive.co.id/images/favicon.png">


    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">
    @stack('styles')
    @livewireStyles

</head>

<body>
    <div class="container-fluid col-11 pt-4">
        <header>
            <img src="{{ asset('/assets/img/Banner.png') }}" class="img-fluid rounded" width="100%"
                alt="{{ $title ?? '' }}">

            <div class="card my-3 border-0">
                <img src="{{ asset('/assets/img/Title_Banner.png') }}" class="img-fluid rounded" width="100%"
                    alt="{{ $title ?? '' }}">
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    @stack('scripts')

    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
</body>

</html>
