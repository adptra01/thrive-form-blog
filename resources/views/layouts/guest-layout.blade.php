<!doctype html>
<html lang="en">

<head>
    <title>
        {{ $title ?? '' }}
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">
    @stack('styles')
    @livewireStyles
    @vite([])
</head>

<body>
    <div class="box">
        <div class="square" style="--i:0;"></div>
        <div class="square" style="--i:1;"></div>
        <div class="square" style="--i:2;"></div>
        <div class="square" style="--i:3;"></div>
        <div class="square" style="--i:4;"></div>
        <div class="square" style="--i:5;"></div>

        <main>
            <div class="container-fluid px-5 pt-5">
                <div class="row">
                    <div class="col-md sticky-column">
                        <div class="sticky-top">
                            <img src="{{ asset('/assets/img/Image_Banner.svg') }}" class="img-fluid rounded"
                                width="100%" alt="{{ $title ?? '' }}">

                            <div class="card border-responsive mb-3 mt-3 mt-md-5">
                                <div class="card-body">
                                    <h6 class="title text-capitalize text-center fw-semibold responsive-font">
                                        Thrive
                                        Blog Competition 2024
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md scroll-column">
                        {{ $slot }}
                    </div>
                </div>
            </div>
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
