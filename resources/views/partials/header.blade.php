<!-- resources/views/partials/header.blade.php -->
 
<header class="bg-white shadow-sm sticky top-0 z-50">

    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">

            @auth
                @if(Auth::user()->role === 'seller')
                    <div class="position-relative me-3 seller-menu-wrapper">
                        <button id="sellerMenuBtn" class="btn btn-outline-success d-flex align-items-center">
                            <i class="fas fa-bars me-1 seller-icon"></i> 
                        </button>

                        <!-- Dropdown aligned to right -->
                        <ul id="sellerDropdown" class="dropdown-menu shadow-lg border-0 position-absolute end-0 mt-2 p-0">
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('seller.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('seller.products.index') }}">
                                <i class="fas fa-box me-2"></i>My Products
                            </a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('seller.orders.index') }}">
                                <i class="fas fa-shopping-bag me-2"></i>Orders
                            </a></li>
                        </ul>
                    </div>
                @endif
            @endauth

            <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i>EasyFarming
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

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