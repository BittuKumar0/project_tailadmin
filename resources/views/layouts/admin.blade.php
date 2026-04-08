<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | EasyFarming</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --sidebar-width: 260px; 
            --farm-green: #10b981;
            --farm-dark: #1f2937;
        }
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f8fafc; 
            overflow-x: hidden;
        }
        
        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #fff;
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }
        .main-wrapper { 
            margin-left: var(--sidebar-width); 
            transition: all 0.3s; 
            min-height: 100vh;
        }
        
        /* Sidebar Links */
        .nav-link-admin {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            border-radius: 12px;
            margin: 4px 16px;
            transition: all 0.3s;
            position: relative;
        }
        .nav-link-admin:hover, .nav-link-admin.active {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: var(--farm-green);
            transform: translateX(4px);
        }
        .nav-link-admin.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: var(--farm-green);
            border-radius: 2px;
        }
        .nav-link-admin i { 
            width: 24px; 
            font-size: 18px; 
            margin-right: 12px;
        }
        
        /* Dropdown Logic */
        .submenu { 
            list-style: none; 
            padding-left: 50px; 
            display: none; 
            background: rgba(16,185,129,0.02);
        }
        .breadcrumb-item {
    list-style: none; 
}
        .submenu.show { 
            display: block; 
        }
        .arrow { 
            margin-left: auto !important; 
            transition: transform 0.3s;
        }
        .rotate-icon { 
            transform: rotate(90deg) !important;
        }
        
        /* Header Styling */
        .admin-header {
            background: rgba(255,255,255,0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            border-bottom: 1px solid #e2e8f0 !important;
        }
        
        /* Main Content */
        main {
            background: #f8fafc;
            padding: 2rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            #sidebar { left: -260px; }
            #sidebar.active { left: 0; }
            .main-wrapper { margin-left: 0; }
        }
        
        @media (max-width: 768px) {
            main { padding: 1rem; }
        }
        
        /* Logo */
        .logo-section {
            background: linear-gradient(135deg, var(--farm-green), #059669);
            border-bottom: none !important;
        }
        
        /* Search Bar */
        .search-input {
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            padding: 12px 20px 12px 50px;
            transition: all 0.3s;
        }
        .search-input:focus {
            border-color: var(--farm-green);
            box-shadow: 0 0 0 0.2rem rgba(16,185,129,0.15);
        }
    </style>
    
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="logo-section p-4 text-white">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-green bg-opacity-20 rounded-4 p-2">
                   <i class="fas fa-seedling me-2"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">Easy<span class="opacity-75">Farming</span></h4>
                    <small class="opacity-75">Admin Panel</small>
                </div>
            </div>
        </div>

        <div class="py-4 px-2">
            <!-- Main Menu -->
            <p class="text-uppercase text-muted small fw-bold px-4 mb-3">MAIN</p>
            <a href="{{ route('admin.dashboard') }}" class="nav-link-admin active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <!-- E-Commerce Dropdown -->
            <div class="dropdown-menu-container">
                <a href="javascript:void(0)" class="nav-link-admin justify-content-between" data-target="ecomSub">
                    <span><i class="fas fa-store"></i> E-Commerce</span>
                    <i class="fas fa-chevron-right small arrow"></i>
                </a>
                <ul class="submenu" id="ecomSub">
                    <li><a href="{{ route('admin.products.index') }}" class="nav-link-admin py-2 small">All Products</a></li>
                    <li><a href="{{ route('admin.products.create') }}" class="nav-link-admin py-2 small">Add Product</a></li>
                    
                    <li><a href="{{ route('admin.orders.index') }}" class="nav-link-admin py-2 small">Orders</a></li>
                </ul>
            </div>

            <a href="{{ route('admin.customers.index') }}" class="nav-link-admin">
                <i class="fas fa-users"></i>
                <span>Customers</span>
            </a>

            <!-- Reports Section -->
        <p class="text-uppercase text-muted small fw-bold px-4 mt-4 mb-3">REPORTS</p>

<a href="{{ route('admin.reports.sales') }}" class="nav-link-admin">
    <i class="fas fa-file-invoice-dollar"></i>
    <span>Sales Report</span>
</a>

<a href="{{ route('admin.reports.analytics') }}" class="nav-link-admin">
    <i class="fas fa-chart-bar"></i>
    <span>Analytics</span>
</a>

            <!-- Settings Section -->
            <p class="text-uppercase text-muted small fw-bold px-4 mt-4 mb-3">SETTINGS</p>
            <a href="#" class="nav-link-admin">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>

            <!-- Logout -->
            <div class="mt-5 pt-4 border-top">
                <a href="#" class="nav-link-admin text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Modern Header (Inspired by your main layout) -->
        <header class="admin-header sticky-top py-3 px-4 d-flex justify-content-between align-items-center">
            <!-- Mobile Toggle -->
            <button class="btn btn-outline-light btn-sm d-lg-none me-2" id="sidebarToggle">
                <i class="fas fa-bars fs-5"></i>
            </button>

            <!-- Breadcrumb & Title -->
            <div class="d-flex align-items-center">
                <h4 class="fw-bold mb-0 me-4 text-dark">Dashboard</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sm mb-0">
                        <div class="position-relative">
                    <input type="text" class="form-control search-input" placeholder="Search products, customers...">
                    <i class="fas fa-search position-absolute start-0 top-50 translate-middle-y ms-3 text-muted"></i>
                </div>
                        
                        <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
                    </ol>
                </nav>
            </div>

            <!-- Right Side: Search + Notifications + Profile -->
            <div class="d-flex align-items-center gap-3">
                <!-- Search -->
               <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-muted">
                    <i class="fas fa-home me-1"></i>
                </a></li>

                <!-- Notifications -->
                <button class="btn btn-outline-green btn-sm position-relative p-2">
                    <i class="fas fa-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </button>

                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none gap-2" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=10b981&color=fff&size=40&bold=true&font-size=0.6" 
                             class="rounded-circle border border-2 border-white" width="42" alt="Admin">
                        <div class="text-start d-none d-md-block">
                            <small class="d-block text-muted mb-0">Admin</small>
                           
                        </div>
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
                                <li><a class="dropdown-item" href="{{ route('password.request') }}"><i class="fas fa-key me-2"></i>Change Password</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger w-100 text-start bg-transparent border-0">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="p-4 p-lg-5">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced Sidebar Submenu Toggle
        document.querySelectorAll('[data-target]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const submenu = document.getElementById(targetId);
                const arrow = this.querySelector('.arrow');
                
                // Close other submenus
                document.querySelectorAll('.submenu').forEach(s => {
                    if (s.id !== targetId) {
                        s.classList.remove('show');
                        const parentArrow = s.previousElementSibling.querySelector('.arrow');
                        if (parentArrow) parentArrow.classList.remove('rotate-icon');
                    }
                });
                
                submenu.classList.toggle('show');
                arrow.classList.toggle('rotate-icon');
            });
        });

        // Mobile Sidebar Toggle
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            });
        }

        // Close sidebar on outside click (mobile)
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });

        // Perfect scrollbar for sidebar (optional enhancement)
        // Add smooth scrolling to sidebar links
        document.querySelectorAll('.nav-link-admin').forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all links
                document.querySelectorAll('.nav-link-admin').forEach(l => l.classList.remove('active'));
                // Add active class to clicked link
                this.classList.add('active');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>