<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Seller Panel')</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body class="bg-gray-50">
<!-- HEADER -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between relative">
        
         <!-- Mobile Hamburger (only show on mobile) -->
        <div class=" relative">
          <button id="menuBtn" class="p-2 bg-white text-gray-700 rounded-md shadow-md">☰</button>

            <!-- Mobile Menu -->
       <!-- Mobile Menu -->
<div id="mobileMenu" class="hidden absolute top-full left-0 w-64 bg-white shadow-lg rounded-b-lg mt-1 border z-50">
    <ul class="flex flex-col">
        <li>
            <a href="{{ route('seller.products.index') }}" class="block px-4 py-3 hover:bg-gray-100">
                Products
            </a>
        </li>
        <li>
            <a href="{{ route('seller.products.create') }}" class="block px-4 py-3 hover:bg-gray-100">
                Add Product
            </a>
        </li>
        <li>
            <a href="{{ route('seller.orders.index') }}" class="block px-4 py-3 hover:bg-gray-100">
                Orders
            </a>
        </li>
        <li>
            <a href="{{ route('seller.customers.index') }}" class="block px-4 py-3 hover:bg-gray-100">
                Customers
            </a>
        </li>
        <li>
            <a href="{{ route('seller.profile') }}" class="block px-4 py-3 hover:bg-gray-100">
                Profile
            </a>
        </li>
    </ul>
</div>
        </div>

        <!-- Logo (Center) -->
        <div class="flex-1 flex justify-center">
            <div class="text-2xl font-bold text-blue-600">
                <i class="fas fa-shopping-bag mr-2"></i>Tailwind
            </div>
        </div>
 <div class="flex items-center space-x-6">
    <a href="{{ route('seller.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 whitespace-nowrap">
        
         <span class="text-xs">Home</span>
    </a>

                <!-- Right Icons -->
                <div class="flex items-center space-x-6">
                    <a href="#" class="flex flex-col items-center text-gray-600 hover:text-blue-600 relative">
                     
                        <span class="text-xs">Wishlist</span>
                    </a>
                    <div class="flex flex-col items-center text-gray-600 hover:text-blue-600 relative">
                    
                        <span class="text-xs">Cart</span>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">2</span>
                    </div>
                   
                </div>


        <!-- Profile Icon (Right) -->
        <div class="hidden lg:flex items-center space-x-4">
            <div class="relative">
                <button onclick="toggleProfileMenu()" 
                    class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center hover:bg-gray-400">
                    <i class="fas fa-user text-gray-700"></i>
                </button>
                <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50">
                    <a href="{{ route('seller.profile') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                        <i class="fas fa-user-edit mr-2"></i>Update Profile
                    </a>
                    <a href="{{ route('seller.profile.change-password') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                        <i class="fas fa-key mr-2"></i>Change Password
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm text-red-600">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>

                    
                </div>
            </div>
        </div>
            </div>
 
</div>

<div class="flex justify-center border-t border-b py-3 overflow-x-auto bg-white space-x-4">
    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 whitespace-nowrap">All</a>
    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 whitespace-nowrap">Electronics</a>
    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 whitespace-nowrap">Fashion</a>
  
    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 whitespace-nowrap">Books</a>
    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 whitespace-nowrap">Sports</a>
</div>
</header>

    <!-- CATEGORIES / FILTERS -->
   <!-- CATEGORIES / FILTERS -->

</header>

<!-- MAIN CONTAINER -->
<div class="container mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-4 gap-8">

    <!-- LEFT SIDEBAR -->
    <div class="lg:block hidden space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="font-bold text-lg mb-4">Filters</h3>
            
            <!-- Price Filter -->
            <div>
                <h4 class="font-semibold mb-3">Price</h4>
                <div class="space-y-2">
                    <label class="flex items-center"><input type="radio" name="price" class="mr-2"><span>₹0 - ₹500</span></label>
                    <label class="flex items-center"><input type="radio" name="price" class="mr-2"><span>₹500 - ₹1,000</span></label>
                    <label class="flex items-center"><input type="radio" name="price" class="mr-2"><span>₹1,000 - ₹5,000</span></label>
                    <label class="flex items-center"><input type="radio" name="price" class="mr-2"><span>₹5,000+</span></label>
                </div>
            </div>

            <!-- Discount Filter -->
            <div class="mt-6">
                <h4 class="font-semibold mb-3">Discount</h4>
                <div class="space-y-2">
                    <label class="flex items-center"><input type="checkbox" class="mr-2"><span>10% and above</span></label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"><span>20% and above</span></label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"><span>30% and above</span></label>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="lg:col-span-3">
        @yield('content')
    </div>

</div>

<!-- Scripts -->
<script>
function toggleProfileMenu(){
    const menu = document.getElementById('profileMenu');
    menu.classList.toggle('hidden');
}

const hamburgerBtn = document.getElementById('menuBtn'); // fixed id
const mobileMenu = document.getElementById('mobileMenu');

hamburgerBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

    // Profile menu toggle
    function toggleProfileMenu() {
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('hidden');
    }

    // Close menus when clicking outside
    document.addEventListener('click', function(event) {
        const isHamburger = hamburgerBtn.contains(event.target);
        const isMenu = mobileMenu.contains(event.target);
        if(!isHamburger && !isMenu) {
            mobileMenu.classList.add('hidden');
        }

        const profileBtn = document.querySelector('[onclick="toggleProfileMenu()"]');
        const profileMenu = document.getElementById('profileMenu');
        if(!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.classList.add('hidden');
        }
    });

</script>

</body>
</html>