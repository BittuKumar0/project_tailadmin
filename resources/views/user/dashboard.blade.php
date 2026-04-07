<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ElectroShop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f5f5;
font-family:Arial, Helvetica, sans-serif;
}

/* Navbar */

.navbar{
background:#0d6efd;
}

.navbar-brand{
color:white;
font-weight:bold;
font-size:22px;
}

.nav-link{
color:white !important;
}

/* Hero Section */

.hero{
background:linear-gradient(90deg,#0d6efd,#6610f2);
color:white;
padding:60px 0;
}

.hero h1{
font-size:42px;
font-weight:700;
}

/* Categories */

.category-box{
background:white;
padding:20px;
text-align:center;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
transition:0.3s;
}

.category-box:hover{
transform:translateY(-5px);
}

/* Product Cards */

.product-card{
border:none;
border-radius:12px;
transition:0.3s;
box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.product-card:hover{
transform:translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.product-card img{
height:200px;
object-fit:cover;
}

.price{
color:#198754;
font-weight:bold;
font-size:18px;
}

/* Footer */

footer{
background:#111;
color:white;
padding:30px 0;
margin-top:60px;
}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg">
<div class="container">

<a class="navbar-brand" href="#">ElectroShop</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#">Products</a></li>
<li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
<li class="nav-item"><a class="nav-link" href="#">Login</a></li>
</ul>

</div>
</div>
</nav>

<!-- Hero Section -->

<section class="hero">
<div class="container text-center">

<h1>Big Sale on Electronics 🔥</h1>
<p>Up to 50% Off on Mobiles, Laptops & Accessories</p>

<a href="#" class="btn btn-light btn-lg mt-3">Shop Now</a>

</div>
</section>

<!-- Categories -->

<div class="container mt-5">

<h3 class="mb-4">Shop by Category</h3>

<div class="row text-center">

<div class="col-md-3">
<div class="category-box">
📱
<h5 class="mt-2">Mobiles</h5>
</div>
</div>

<div class="col-md-3">
<div class="category-box">
💻
<h5 class="mt-2">Laptops</h5>
</div>
</div>

<div class="col-md-3">
<div class="category-box">
🎧
<h5 class="mt-2">Headphones</h5>
</div>
</div>

<div class="col-md-3">
<div class="category-box">
⌚
<h5 class="mt-2">Smart Watches</h5>
</div>
</div>

</div>
</div>

<!-- Products -->

<div class="container mt-5">

<h3 class="mb-4">Latest Products</h3>

<div class="row">

@foreach($products as $product)

<div class="col-md-3 mb-4">
    <div class="card h-100">
        <img src="{{ $product->image ?? 'https://via.placeholder.com/150' }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text"><strong>₹{{ $product->price }}</strong></p>
            <a href="#" class="btn btn-primary w-100">Buy Now</a>

        </div>
    </div>
</div>
@endforeach

</div>

</div>

<!-- Footer -->

<footer>

<div class="container text-center">

<p>© 2026 ElectroShop | Electronics Store</p>

</div>

</footer>

</body>
</html>