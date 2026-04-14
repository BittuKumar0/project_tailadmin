<!-- resources/views/partials/header.blade.php -->
 <style>
 /* Container focus effect */
.search-container {
    transition: all 0.3s ease;
}

/* Modern Pill Shape & Border Fix */
.modern-search-bar {
    border-radius: 40px;
    overflow: hidden; /* This ensures the corners stay rounded */
    border: 1px solid #28a745;
    background-color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Removing individual borders from group items to use the container border */
.modern-search-bar .input-group-text,
.modern-search-bar .form-control,
.modern-search-bar .btn {
    border: none !important;
}

/* Input text styling */
.modern-search-bar .form-control {
    font-size: 0.95rem;
    height: 45px;
    color: #333;
}

.modern-search-bar .form-control::placeholder {
    color: #aaa;
    font-weight: 400;
}

/* Search Button Styling */
.modern-search-bar .btn-success {
    background-color: #28a745;
    color: #fff;
    letter-spacing: 0.5px;
    padding-left: 25px;
    padding-right: 25px;
    transition: background 0.2s ease;
}

.modern-search-bar .btn-success:hover {
    background-color: #218838;
}

/* Active/Focus State for the whole bar */
.search-container:focus-within .modern-search-bar {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
}

/* Mobile Adjustments */
@media (max-width: 576px) {
    .modern-search-bar .btn-success {
        padding-left: 15px;
        padding-right: 15px;
        font-size: 0.85rem;
    }
}



/* Main Button Design */
.btn-seller-nav {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    color: #1a202c;
    border-radius: 50px;
    padding: 6px 16px;
    transition: all 0.3s ease;
}

.btn-seller-nav:hover, .btn-seller-nav:focus {
    background-color: #f8fafc;
    border-color: #28a745;
    color: #28a745;
}

.btn-seller-nav i.fa-store {
    color: #28a745;
    font-size: 1.1rem;
}

/* Dropdown Menu Customization */
.seller-dropdown-custom {
    min-width: 220px;
    border-radius: 12px;
    padding: 8px;
    animation: fadeInDown 0.3s ease;
}

.seller-dropdown-custom .dropdown-item {
    border-radius: 8px;
    font-weight: 500;
    color: #4a5568;
    transition: all 0.2s;
}

.seller-dropdown-custom .dropdown-item:hover {
    background-color: #f0fff4;
    color: #2f855a;
    transform: translateX(5px);
}

/* Icon Box inside Dropdown */
.icon-box {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 0.9rem;
}

/* Soft Colors for Icons */
.bg-soft-success { background: #e6fffa; color: #38a169; }
.bg-soft-primary { background: #ebf8ff; color: #3182ce; }
.bg-soft-warning { background: #fffaf0; color: #dd6b20; }
.bg-soft-danger  { background: #fff5f5; color: #e53e3e; }

/* Entry Animation */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Header styling */
.dropdown-header {
    letter-spacing: 1px;
    padding-bottom: 8px;
}

</style>
<header class="bg-white shadow-sm sticky top-0 z-50">

    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">

          @auth
    @if(Auth::user()->role === 'seller')
        <div class="dropdown me-3 seller-menu-wrapper">
            <button class="btn btn-seller-nav d-flex align-items-center shadow-sm" 
                    type="button" 
                    id="sellerMenuBtn" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                <i class="fa fa-bars"></i>
         
              
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 seller-dropdown-custom" aria-labelledby="sellerMenuBtn">
                <li class="dropdown-header text-uppercase small fw-bold text-muted border-bottom mb-1">Manage Store</li>
                
                <li><a class="dropdown-item py-2" href="{{ route('seller.dashboard') }}">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-soft-success me-3"><i class="fas fa-chart-line"></i></div>
                        <span>Dashboard</span>
                    </div>
                </a></li>
                
                <li><a class="dropdown-item py-2" href="{{ route('seller.products.index') }}">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-soft-primary me-3"><i class="fas fa-boxes"></i></div>
                        <span>My Products</span>
                    </div>
                </a></li>
                
                <li><a class="dropdown-item py-2" href="{{ route('seller.orders.index') }}">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-soft-warning me-3"><i class="fas fa-clipboard-list"></i></div>
                        <span>Orders</span>
                    </div>
                </a></li>
                
             
            </ul>
        </div>
    @endif
@endauth

           <a class="navbar-brand fw-bold text-success d-flex align-items-center fs-2" href="{{ url('/') }}">
    <i class="fas fa-seedling me-2"></i>EasyFarming
</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
    <form action="{{ Route::has('products.search') ? route('products.search') : '#' }}" method="GET" class="mx-auto col-lg-5 col-md-6 px-2">
    <div class="search-container">
        <div class="input-group modern-search-bar-compact">
            <span class="input-group-text bg-white border-success border-end-0 ps-3">
                <i class="fas fa-search text-muted small"></i>
            </span>
            
            <input 
                type="text" 
                name="query" 
                class="form-control border-success border-start-0 border-end-0 shadow-none" 
                placeholder="Search products..." 
                value="{{ request('query') }}"
                required
            >

            <button class="btn btn-success px-3 fw-bold" type="submit">
                SEARCH
            </button>
        </div>
    </div>
</form>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Home</a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item ms-3">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                            <i class="fas fa-shopping-cart fs-5"></i>
                            <span class="cart-count badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill small"
                                  style="display: {{ Session::has('cart') && count(Session::get('cart')) > 0 ? 'inline-block' : 'none' }};">
                                {{ Session::has('cart') ? array_sum(array_column(Session::get('cart'), 'quantity')) : 0 }}
                            </span>
                        </a>
                    </li>

                    @guest
                        <li class="nav-item ms-3">
                            <a class="nav-link btn btn-outline-success px-3 py-2" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link btn btn-success px-3 py-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @else
                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=10b981&background=059669' }}"
                                    class="rounded-circle me-2" width="32" height="32" alt="{{ Auth::user()->name }}">
                                @if(Auth::user()->role === 'seller')
                                    <span class="badge bg-warning text-dark ms-1">Seller</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="userDropdown">
                                <li class="dropdown-item py-3 bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=10b981&background=059669' }}"
                                            class="rounded-circle me-3" width="48" height="48">
                                        <div>
                                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                                 <li><a class="dropdown-item" href="{{  route('customer.orders') }}"><i class="fas fa-user-edit me-2"></i>My orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.password-update')  }}"><i class="fas fa-key me-2"></i>Change Password</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger w-100 text-start bg-transparent border-0">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <!-- Categories Slider -->
    <div class="bg-light py-4 border-top">
        <div class="container">
            <div class="category-wrapper position-relative">
                <button class="nav-btn prev-btn"><i class="fas fa-chevron-left"></i></button>

                <div class="category-slider" id="categorySlider">
                    @php
                        $categories = [
                            ['id'=>1,'name'=>'Nutrients','img'=>'seeds.jpg'],
                            ['id'=>2,'name'=>'Fungicides','img'=>'fungicides.jpg'],
                            ['id'=>3,'name'=>'Insecticides','img'=>'fertilizers.jpg'],
                            ['id'=>4,'name'=>'Seeds','img'=>'seeds.jpg'],
                            ['id'=>5,'name'=>'Weedicides','img'=>'weedicides.jpg'],
                            ['id'=>6,'name'=>'Tissue Culture','img'=>'tissue.jpg'],
                            ['id'=>7,'name'=>'Fertilizers','img'=>'fertilizers.jpg'],
                            ['id'=>8,'name'=>'Hardware','img'=>'hardware.jpg'],
                        ];
                    @endphp

                    @foreach($categories as $cat)
                        <a href="{{ route('collections.category', $cat['id']) }}" class="category-card">
                            <img src="{{ asset('images/categories/'.$cat['img']) }}" alt="{{ $cat['name'] }}">
                            <p>{{ $cat['name'] }}</p>
                        </a>
                    @endforeach
                </div>

                <button class="nav-btn next-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</header>

<!-- ==================== CSS ==================== -->
<style>
.category-wrapper { position: relative; overflow: hidden; }
.category-slider { display: flex; gap: 20px; overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; }
.category-slider::-webkit-scrollbar { display: none; }
.category-card { flex: 0 0 calc(16.66% - 15px); text-align: center; text-decoration: none; color: #333; }
.category-card img { width: 100%; height: 120px; object-fit: cover; border-radius: 12px; transition: 0.3s; }
.category-card p { margin-top: 8px; font-weight: 600; }
.category-card:hover img { transform: scale(1.08); }
.nav-btn { position: absolute; top: 40%; transform: translateY(-50%); background: #fff; border: 1px solid #ddd; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; z-index: 10; }
.prev-btn { left: -15px; }
.next-btn { right: -15px; }
@media (max-width: 992px) { .category-card { flex: 0 0 calc(33.33% - 10px); } }
@media (max-width: 576px) { .category-card { flex: 0 0 80%; } }
</style>

<!-- ==================== JS ==================== -->
 <!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-F2G0kF+85oJq3EjBdovB/90B7J44kvsZq9m7dEokJ5C2+g6m+7E+Tcq5oMXrjYhG" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const sellerBtn = document.getElementById('sellerMenuBtn');
    const sellerDropdown = document.getElementById('sellerDropdown');

    sellerBtn.addEventListener('click', () => {
        sellerDropdown.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!sellerBtn.contains(e.target) && !sellerDropdown.contains(e.target)) {
            sellerDropdown.classList.remove('show');
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("categorySlider");
    const nextBtn = document.querySelector(".next-btn");
    const prevBtn = document.querySelector(".prev-btn");
    const scrollAmount = slider.clientWidth / 2;

    nextBtn.addEventListener("click", () => slider.scrollBy({ left: scrollAmount, behavior: "smooth" }));
    prevBtn.addEventListener("click", () => slider.scrollBy({ left: -scrollAmount, behavior: "smooth" }));

    let autoSlide = setInterval(() => {
        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) slider.scrollTo({ left: 0, behavior: "smooth" });
        else slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
    }, 4000);

    slider.addEventListener("mouseenter", () => clearInterval(autoSlide));
    slider.addEventListener("mouseleave", () => {
        autoSlide = setInterval(() => {
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) slider.scrollTo({ left: 0, behavior: "smooth" });
            else slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }, 4000);
    });
});
</script>