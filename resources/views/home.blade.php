    @extends('layouts.app')

    @push('styles')
    <style>
.feedback-slider {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.feedback-slider::-webkit-scrollbar {
    display: none;
}

.feedback-card {
    flex: 0 0 calc(25% - 15px); /* 4 show */
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.feedback-card img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.feedback-card h6 {
    font-weight: 600;
}

.feedback-card .stars {
    color: #ffc107;
    margin-bottom: 8px;
}

.feedback-card p {
    font-size: 14px;
    color: #555;
}

/* BUTTON */
.fb-btn {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.prev-fb { left: -10px; }
.next-fb { right: -10px; }

/* RESPONSIVE */
@media (max-width: 992px) {
    .feedback-card { flex: 0 0 50%; }
}

@media (max-width: 576px) {
    .feedback-card { flex: 0 0 80%; }
}
.brand-wrapper {
    position: relative;
    overflow: hidden;
}

.brand-slider {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.brand-slider::-webkit-scrollbar {
    display: none;
}

/* ✅ SHOW 6 ITEMS */
.brand-card {
    flex: 0 0 calc(16.66% - 15px);
    text-align: center;
}

.brand-card img {
    width: 100%;
    height: 80px;
    object-fit: contain;
    padding: 10px;
    background: #fff;
    border-radius: 10px;
    transition: 0.3s;
}

.brand-card p {
    margin-top: 8px;
    font-weight: 600;
    font-size: 14px;
}

.brand-card:hover img {
    transform: scale(1.08);
}

/* BUTTONS */
.brand-btn {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    z-index: 10;
}

.prev-brand { left: -15px; }
.next-brand { right: -15px; }

/* 📱 RESPONSIVE */
@media (max-width: 992px) {
    .brand-card { flex: 0 0 25%; } /* 4 items */
}

@media (max-width: 576px) {
    .brand-card { flex: 0 0 50%; } /* 2 items */
}

.trending-products h2 { margin-bottom: 2rem; }
.sale-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: red;
    color: #fff;
    padding: 3px 8px;
    font-size: 12px;
    border-radius: 5px;
}

/* ADD BUTTON */
.add-first {
    background: #28a745;
    color: #fff;
    border: none;
    padding: 8px;
    border-radius: 6px;
    font-weight: 600;
    transition: 0.3s;
}

.add-first:hover {
    background: #218838;
}

/* QTY BOX */
.qty-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #28a745;
    color: #fff;
    border-radius: 6px;
    padding: 5px 10px;
}

.qty-box button {
    background: #fff;
    color: #28a745;
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 4px;
    font-weight: bold;
}

.qty {
    font-weight: bold;
}

    /* Existing styles + New additions */
    .brand-section { background: linear-gradient(135deg, #f8f9fa, #e9ecef); }
    .brand-logo { 
        height: 80px; 
        width: 120px; 
        object-fit: contain; 
        border-radius: 10px; 
        transition: transform 0.3s;
    }
    .brand-logo:hover { transform: scale(1.05); }
    .app-download-section { 
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
    }
    .download-buttons { gap: 15px; }
    @media (max-width: 768px) { .download-buttons { flex-direction: column; } }
    </style>
    @endpush

    @section('content')

    {{-- Hero Section (Fixed with asset()) --}}
    <section class="hero-section py-5">
      <div id="topHeroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
        @php
            $heroSlides = [
             
                'storage/images/categories/banana.jpg',
                'storage/images/categories/newtwo.jpg', 
                'storage/images/categories/newfour.jpg',
                'storage/images/categories/newone.jpg',
            ];

            // Group slides in chunks of 2
            $chunks = array_chunk($heroSlides, 2);
        @endphp

        @foreach($chunks as $index => $chunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row">
                    @foreach($chunk as $slide)
                        <div class="col-md-6">
                            <img src="{{ asset($slide) }}" class="d-block w-100" 
                                 style="height: 300px; object-fit: cover;" 
                                 alt="Slide Images">
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#topHeroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#topHeroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
    </section>


<!-- ================= Trending Products Section ================= -->
<section class="trending-products py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 fw-bold text-center">This Week’s Trending Products</h2>

        <div class="trending-slider-wrapper position-relative">

            <!-- Left/Right Nav Buttons -->
            <button class="nav-btn prev-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="nav-btn next-btn">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div class="trending-slider d-flex gap-3 overflow-x-auto scroll-smooth">
                @php
                    $trendingProducts = [
                        [
                            'name'=>'Aries Agripro Micronutrient',
                            'img'=>'/storage/images/categories/nut7.jpg',
                            'regular'=>650,
                            'sale'=>578
                        ],
                        [
                            'name'=>'Sumitomo Taboli Plant Growth Regulator',
                            'img'=>'/storage/images/categories/nut3.jpg',
                            'regular'=>899,
                            'sale'=>790
                        ],
                                 ['name'=>'Sprayer 20L Battery Operated Models',
                                 'img'=>'/storage/images/categories/battery.jpg',
                                 'regular'=>3600,'sale'=>3200],

                        ['name'=>'Roundup (Glyphosate)',
                        'img'=>'/storage/images/categories/roundup.jpg',
                        'regular'=>850,'sale'=>600],


                         ['name'=>'Wheat Seeds Deluxe',
                             'img'=>'/storage/images/categories/wheat.jpg',
                             'regular'=>150,'sale'=>130],
                               ['name'=>'DAP (IFFCO Brand)',
                                    'img'=>'/storage/images/categories/dap.jpg',
                                    'regular'=>2250,'sale'=>1350],

                        // Add more products as needed
                    ];
                @endphp

                @foreach($trendingProducts as $product)
                    <div class="card product-card border-0 shadow-sm flex-shrink-0" style="width: 220px;">
                        <img src="{{ asset($product['img']) }}" class="card-img-top" alt="{{ $product['name'] }}" style="height:160px; object-fit:cover;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ $product['name'] }}</h6>
                            <p class="mb-2">
                                <span class="text-muted text-decoration-line-through">Rs. {{ $product['regular'] }}</span>
                                <span class="fw-bold text-danger ms-1">Rs. {{ $product['sale'] }}</span>
                            </p>
                            <div class="mt-auto cart-control d-flex align-items-center gap-2">
                                <button class="btn btn-success add-first w-100"> + Add</button>
                                <div class="qty-box d-none d-flex align-items-center gap-2">
                                    <button class="btn btn-outline-secondary minus">-</button>
                                    <span class="qty">1</span>
                                    <button class="btn btn-outline-secondary plus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>


<section class="feedback-section py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-success">👨‍🌾 Farmers Feedback</h2>
            <p class="text-muted">What our farmers say about us</p>
        </div>

        <div class="feedback-wrapper position-relative">

            <!-- LEFT -->
            <button class="fb-btn prev-fb">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- SLIDER -->
            <div class="feedback-slider" id="feedbackSlider">

                <!-- CARD 1 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg">
                    <h6>Ramesh Kumar</h6>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>“Bahut accha product hai, meri fasal ka growth improve hua.”</p>
                </div>

                <!-- CARD 2 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg">
                    <h6>Suresh Patel</h6>
                    <div class="stars">⭐⭐⭐⭐</div>
                    <p>“Fertilizers quality best hai, delivery bhi fast mili.”</p>
                </div>

                <!-- CARD 3 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/60.jpg">
                    <h6>Mahesh Singh</h6>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>“Seeds germination bahut achha hai, recommend karta hoon.”</p>
                </div>

                <!-- CARD 4 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg">
                    <h6>Rajveer</h6>
                    <div class="stars">⭐⭐⭐⭐</div>
                    <p>“Insecticide effective hai, pests control ho gaye.”</p>
                </div>

                <!-- CARD 5 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/70.jpg">
                    <h6>Deepak Yadav</h6>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>“Customer support bhi accha hai, full satisfied.”</p>
                </div>
                 <!-- CARD 5 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/60.jpg">
                    <h6>Ram kumar Yadav</h6>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>“Customer support bhi accha hai, full satisfied.”</p>
                </div>
                 <!-- CARD 5 -->
                <div class="feedback-card">
                    <img src="https://randomuser.me/api/portraits/men/89.jpg">
                    <h6>Suresh Saini</h6>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>“Customer support bhi accha hai, full satisfied.”</p>
                </div>

            </div>

            <!-- RIGHT -->
            <button class="fb-btn next-fb">
                <i class="fas fa-chevron-right"></i>
            </button>

        </div>

    </div>
</section>

    {{-- SHOP BY BRANDS SECTION - PERFECT WORKING --}}
    <section class="brand-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-success mb-3">
                    🛒 <span class="text-dark">Shop by</span> Brands
                </h2>
                <p class="lead text-muted">Trusted brands for all your farming needs</p>
             
            </div>
            
            <div class="row g-4 justify-content-center">

<div class="brand-wrapper position-relative">

    <!-- LEFT BUTTON -->
    <button class="brand-btn prev-brand">
        <i class="fas fa-chevron-left"></i>
    </button>

    <!-- SLIDER -->
    <div class="brand-slider" id="brandSlider">

        <!-- BRAND ITEM -->
        <div class="brand-card">
            <a href="/brands/dhanuka">
                <img src="{{ asset('/storage/images/categories/dhanuka.png') }}">
                <p>Dhanuka</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/bayer">
                <img src="{{ asset('/storage/images/categories/bayer.jpg') }}">
                <p>Bayer</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/iffco">
                <img src="{{ asset('/storage/images/categories/iffco.png') }}">
                <p>Iffco</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/aries">
                <img src="{{ asset('/storage/images/categories/aries.jpg') }}">
                <p>Aries</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/sumitomo">
                <img src="{{ asset('/storage/images/categories/sumitomo.jpeg') }}">
                <p>Sumitomo</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/syngenta">
                <img src="{{ asset('/storage/images/categories/syngenta.jpg') }}">
                <p>Syngenta</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/upl">
                <img src="{{ asset('/storage/images/categories/upl.png') }}">
                <p>UPL</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/yara">
                <img src="{{ asset('/storage/images/categories/yara.jpg') }}">
                <p>Yara</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/adama">
                <img src="{{ asset('/storage/images/categories/adama.jpg') }}">
                <p>Adama</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/fmc">
                <img src="{{ asset('/storage/images/categories/fmc.png') }}">
                <p>FMC</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/rallis">
                <img src="{{ asset('/storage/images/categories/rallis.jpg') }}">
                <p>Rallis</p>
            </a>
        </div>

        <div class="brand-card">
            <a href="/brands/basf">
                <img src="{{ asset('/storage/images/categories/basf.png') }}">
                <p>BASF</p>
            </a>
        </div>

    </div>

    <!-- RIGHT BUTTON -->
    <button class="brand-btn next-brand">
        <i class="fas fa-chevron-right"></i>
    </button>

</div>
            </div>
        </div>
    </section>


    
@foreach($categories as $category)
<section class="py-5 {{ $loop->even ? 'bg-light' : 'bg-white' }}">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">{{ $category->name }}</h3>
                <div style="width: 50px; height: 3px; background: #198754; border-radius: 10px;"></div>
            </div>
            <a href="{{ route('collections.category', $category->id) }}" 
               class="btn btn-sm btn-outline-success rounded-pill px-4 fw-bold">
               View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div id="{{ Str::slug($category->name) }}Carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($category->products->chunk(4) as $chunkIndex => $products)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach($products as $product)
                        <div class="col-6 col-md-3">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                                
                                @php
                                    $regular = $product->regular_price ?? $product->price;
                                    $sale = $product->sale_price ?? $product->price;
                                    $discount = ($regular > $sale) ? round((($regular - $sale)/$regular)*100) : 0;
                                @endphp

                                @if($discount > 0)
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 shadow-sm" style="z-index: 5;">
                                        {{ $discount }}% OFF
                                    </span>
                                @endif

@php
    // Agar image field string hai to decode karo, agar array hai to use karo
    $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
    $firstImage = $images[0] ?? 'default.jpg';
@endphp

<img src="{{ asset('storage/products/' . $firstImage) }}" 
     class="card-img-top" style="height:200px; object-fit:cover;">

                                <div class="card-body p-3 d-flex flex-column">
                                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                        <h6 class="text-dark fw-bold text-truncate mb-1">{{ $product->name }}</h6>
                                    </a>
                                    <p class="text-muted small mb-2">EasyFarming Choice</p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <span class="text-success fw-bold fs-5">₹{{ number_format($sale) }}</span>
                                            @if($discount > 0)
                                                <small class="text-muted text-decoration-line-through">₹{{ number_format($regular) }}</small>
                                            @endif
                                        </div>

                                        <div class="d-flex gap-3">
      <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="1">
    
    <button type="submit" class="btn btn-success rounded-pill fw-bold py-2 shadow-sm w-100">
        <i class="fas fa-cart-plus me-1"></i> Add 
    </button>
</form>
                                           <a href="{{ route('products.show', $product->id) }}" 
   class="btn btn-outline-success btn-sm rounded-pill d-inline-flex align-items-center justify-content-center" 
   style="width: 90px; height: 45px;" 
   title="View Details">
    <i class="fas fa-eye"></i> view
</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#{{ Str::slug($category->name) }}Carousel" data-bs-slide="prev" style="width: 5%;">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{{ Str::slug($category->name) }}Carousel" data-bs-slide="next" style="width: 5%;">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</section>
@endforeach

<style>
    .product-card { transition: all 0.3s ease-in-out; border: 1px solid #eee !important; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; border-color: #198754 !important; }
    .carousel-control-prev, .carousel-control-next { filter: invert(1); }
</style>

  @endsection
<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".cart-control").forEach(control => {

        let addBtn = control.querySelector(".add-first");
        let qtyBox = control.querySelector(".qty-box");
        let qtyText = control.querySelector(".qty");

        let qty = 1;

        addBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            addBtn.classList.add("d-none");
            qtyBox.classList.remove("d-none");
        });

        control.querySelector(".plus").addEventListener("click", function (e) {
            e.stopPropagation();
            qty++;
            qtyText.innerText = qty;
        });

        control.querySelector(".minus").addEventListener("click", function (e) {
            e.stopPropagation();

            if (qty > 1) {
                qty--;
                qtyText.innerText = qty;
            } else {
                qtyBox.classList.add("d-none");
                addBtn.classList.remove("d-none");
                qty = 1;
            }
        });

    });

});



document.addEventListener("DOMContentLoaded", function() {

    const slider = document.querySelector(".trending-slider");
    const nextBtn = document.querySelector(".next-btn");
    const prevBtn = document.querySelector(".prev-btn");

    const scrollAmount = 240; // adjust according to card width + gap

    nextBtn.addEventListener("click", () => {
        slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
    prevBtn.addEventListener("click", () => {
        slider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    // AUTO SCROLL
    let autoScroll = setInterval(() => {
        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
            slider.scrollTo({ left: 0, behavior: "smooth" });
        } else {
            slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }
    }, 4000);

    slider.addEventListener("mouseenter", () => clearInterval(autoScroll));
    slider.addEventListener("mouseleave", () => {
        autoScroll = setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollTo({ left: 0, behavior: "smooth" });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
            }
        }, 4000);
    });

    // ================= Quantity Buttons =================
    document.querySelectorAll(".cart-control").forEach(control => {
        let addBtn = control.querySelector(".add-first");
        let qtyBox = control.querySelector(".qty-box");
        let qtyText = control.querySelector(".qty");
        let qty = 1;

        addBtn.addEventListener("click", function(e) {
            e.stopPropagation();
            addBtn.classList.add("d-none");
            qtyBox.classList.remove("d-none");
        });

        control.querySelector(".plus").addEventListener("click", function(e) {
            e.stopPropagation();
            qty++;
            qtyText.innerText = qty;
        });

        control.querySelector(".minus").addEventListener("click", function(e) {
            e.stopPropagation();
            if(qty > 1){
                qty--;
                qtyText.innerText = qty;
            } else {
                qtyBox.classList.add("d-none");
                addBtn.classList.remove("d-none");
                qty = 1;
            }
        });
    });

});


document.addEventListener("DOMContentLoaded", function () {

    const slider = document.getElementById("brandSlider");
    const next = document.querySelector(".next-brand");
    const prev = document.querySelector(".prev-brand");

    const scrollAmount = slider.clientWidth;

    next.addEventListener("click", () => {
        slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });

    prev.addEventListener("click", () => {
        slider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    // AUTO SLIDE
    let auto = setInterval(() => {
        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
            slider.scrollTo({ left: 0, behavior: "smooth" });
        } else {
            slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }
    }, 4000);

    // PAUSE ON HOVER
    slider.addEventListener("mouseenter", () => clearInterval(auto));

    slider.addEventListener("mouseleave", () => {
        auto = setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollTo({ left: 0, behavior: "smooth" });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
            }
        }, 4000);
    });

});
document.addEventListener("DOMContentLoaded", function () {

    const slider = document.getElementById("feedbackSlider");
    const next = document.querySelector(".next-fb");
    const prev = document.querySelector(".prev-fb");

    const scrollAmount = slider.clientWidth;

    next.addEventListener("click", () => {
        slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });

    prev.addEventListener("click", () => {
        slider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    // AUTO SLIDE
    setInterval(() => {
        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
            slider.scrollTo({ left: 0, behavior: "smooth" });
        } else {
            slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }
    }, 4000);

});

</script>