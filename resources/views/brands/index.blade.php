@extends('layouts.app')

@section('content')

<section class="brand-section py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-success">
                🛒 <span class="text-dark">Shop by Brands</span>
            </h2>
            <p class="text-muted">Trusted brands for all your farming needs</p>
        </div>

        <div class="brand-wrapper px-4">

            <button class="brand-btn prev-brand shadow">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="brand-slider" id="brandSlider">
                @foreach($brands as $brand)
                <div class="brand-card text-center shadow-sm p-3 rounded-4 bg-white border">
                    <a href="{{ url('/brands/'.$brand['id']) }}" class="text-decoration-none">
                        @php
                            // 1. Data Handle Karein (Check if 'img' exists or 'images')
                            $imgData = $brand['img'] ?? $brand['images'] ?? 'default.jpg';
                            
                            // 2. JSON Decoding (Multiple images handling)
                            $decoded = is_string($imgData) ? json_decode($imgData, true) : $imgData;
                            
                            // 3. Select First Image
                            if (is_array($decoded) && count($decoded) > 0) {
                                $displayImg = $decoded[0];
                            } else {
                                $displayImg = is_string($imgData) ? $imgData : 'default.jpg';
                            }

                            // 4. Final Path
                            $imagePath = asset('storage/products/' . $displayImg);
                        @endphp
                        
                        <div class="brand-img-wrapper mb-3">
                            <img src="{{ $imagePath }}" 
                                 alt="{{ $brand['name'] }}" 
                                 class="img-fluid rounded-3" 
                                 style="height: 80px; width: 100%; object-fit: contain;"
                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/100x100?text=No+Image';">
                        </div>
                        
                        <h6 class="fw-bold text-dark mb-0 text-truncate">{{ $brand['name'] }}</h6>
                        <small class="text-muted small">Explore Products</small>
                    </a>
                </div>
                @endforeach
            </div>

            <button class="brand-btn next-brand shadow">
                <i class="fas fa-chevron-right"></i>
            </button>

        </div>
    </div>
</section>

<style>
/* WRAPPER RELATIVE FOR BUTTONS */
.brand-wrapper {
    position: relative;
}

/* SLIDER LAYOUT */
.brand-slider {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 15px 5px;
    scrollbar-width: none; /* Firefox */
}

.brand-slider::-webkit-scrollbar {
    display: none; /* Chrome/Safari */
}

/* CARD STYLING */
.brand-card {
    flex: 0 0 calc(16.66% - 17px); /* Desktop: 6 items */
    min-width: 150px;
    transition: all 0.3s ease;
}

.brand-card:hover {
    transform: translateY(-8px);
    border-color: #198754 !important;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.brand-img-wrapper {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 10px;
}

/* NAVIGATION BUTTONS */
.brand-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: #fff;
    color: #198754;
    cursor: pointer;
    z-index: 10;
    transition: 0.3s;
}

.brand-btn:hover {
    background: #198754;
    color: #fff;
}

.prev-brand { left: -10px; }
.next-brand { right: -10px; }

/* RESPONSIVE BREAKPOINTS */
@media (max-width: 1200px) {
    .brand-card { flex: 0 0 calc(25% - 15px); } /* 4 items */
}

@media (max-width: 768px) {
    .brand-card { flex: 0 0 calc(50% - 10px); } /* 2 items */
    .prev-brand { left: 0; }
    .next-brand { right: 0; }
}

@media (max-width: 480px) {
    .brand-card { flex: 0 0 70%; } /* Mobile focus */
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("brandSlider");
    const nextBtn = document.querySelector(".next-brand");
    const prevBtn = document.querySelector(".prev-brand");

    if (!slider) return;

    // Scroll Logic
    const scrollAmount = 300;

    nextBtn.addEventListener("click", () => {
        slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });

    prevBtn.addEventListener("click", () => {
        slider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    // Auto-slide functionality
    let autoSlide = setInterval(() => {
        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
            slider.scrollTo({ left: 0, behavior: "smooth" });
        } else {
            slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }
    }, 4000);

    // Pause on hover
    slider.addEventListener("mouseenter", () => clearInterval(autoSlide));
    slider.addEventListener("mouseleave", () => {
        autoSlide = setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                slider.scrollTo({ left: 0, behavior: "smooth" });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
            }
        }, 4000);
    });
});
</script>

@endsection