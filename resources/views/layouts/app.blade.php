<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EasyFarming - Premium Agriculture Products')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .min-vh-90 { min-height: 90vh; }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
    
    {{-- HEADER --}}
    @include('partials.header')

    {{-- MAIN CONTENT --}}
    <main class="container-fluid py-4 min-vh-90">
        {{-- Search results status message (Optional) --}}
        @if(request('query'))
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-xl-10">
                <div class="alert alert-light border-0 shadow-sm">
                    Showing results for: <span class="text-success fw-bold">"{{ request('query') }}"</span>
                </div>
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-xl-10 col-xxl-9">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Swiper Initialization
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".categorySwiper", {
                slidesPerView: 6,
                spaceBetween: 20,
                breakpoints: {
                    320: { slidesPerView: 2 },
                    768: { slidesPerView: 4 },
                    1024: { slidesPerView: 6 }
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>