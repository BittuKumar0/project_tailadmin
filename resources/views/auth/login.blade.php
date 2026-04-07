<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (Eye Icon) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
background: linear-gradient(135deg,#4e73df,#1cc88a);
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.login-card{
width:400px;
padding:35px;
border-radius:10px;
background:#fff;
box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.login-title{
text-align:center;
font-weight:600;
margin-bottom:25px;
}

.password-wrapper{
position:relative;
}

.eye-icon{
position:absolute;
right:15px;
top:50%;
transform:translateY(-50%);
cursor:pointer;
color:#888;
}

</style>
</head>

<body>

<div class="login-card">

<h3 class="login-title">Laravel Login</h3>

@if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
{{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
@csrf

<!-- Email -->
<div class="mb-3">
<label>Email Address</label>
<input type="email"
name="email"
value="{{ old('email') }}"
class="form-control"
required>
<div class="invalid-feedback">
Please enter valid email
</div>
</div>

<!-- Password -->
<div class="mb-3">
<label>Password</label>

<div class="password-wrapper">

<input type="password"
name="password"
id="password"
class="form-control"
required>

<i class="fa-solid fa-eye eye-icon" id="togglePassword"></i>

</div>

<div class="invalid-feedback">
Password is required
</div>

</div>

<!-- Login Button -->
<button type="submit" class="btn btn-primary w-100">
Login
</button>

@if (Route::has('password.request'))
<div class="text-center mt-3">
<a href="{{ route('password.request') }}">
Forgot Password?
</a>
</div>
@endif

</form>

</div>

<!-- JS -->

<script>

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function () {

const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
password.setAttribute('type', type);

this.classList.toggle('fa-eye');
this.classList.toggle('fa-eye-slash');

});


// Bootstrap Validation
(() => {
'use strict'

const forms = document.querySelectorAll('.needs-validation')

Array.from(forms).forEach(form => {
form.addEventListener('submit', event => {

if (!form.checkValidity()) {
event.preventDefault()
event.stopPropagation()
}

form.classList.add('was-validated')

}, false)
})
})()

</script>

</body>
</html>