<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
body {
    background: linear-gradient(135deg,#667eea,#764ba2);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family: Arial, sans-serif;
}

.register-card {
    width: 450px;
    padding: 35px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.title {
    text-align: center;
    font-weight: 600;
    margin-bottom: 25px;
}

.input-group-text {
    cursor: pointer;
}
</style>
</head>
<body>

<div class="register-card">
<h3 class="title">User Registration</h3>

<form method="POST" action="{{ route('register') }}">
@csrf

<!-- Role Select -->
<div class="mb-3">
<label class="form-label">Select Role</label>
<select name="role" class="form-select" >
    <option value="">Choose Role</option>
    <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
</select>
@error('role')
    <span class="text-danger small">{{ $message }}</span>
@enderror
</div>

<!-- Name -->
<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
@error('name')
    <span class="text-danger small">{{ $message }}</span>
@enderror
</div>

<!-- Email -->
<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" >
@error('email')
    <span class="text-danger small">{{ $message }}</span>
@enderror
</div>

<!-- Password -->
<div class="mb-3">
<label class="form-label">Password</label>
<div class="input-group">
<input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
<span class="input-group-text" onclick="togglePassword('password','eye1')">
<i class="bi bi-eye" id="eye1"></i>
</span>
</div>
@error('password')
    <span class="text-danger small">{{ $message }}</span>
@enderror
</div>

<!-- Confirm Password -->
<div class="mb-3">
<label class="form-label">Confirm Password</label>
<div class="input-group">
<input type="password" name="password_confirmation" class="form-control" id="confirm_password" placeholder="Confirm password" required>
<span class="input-group-text" onclick="togglePassword('confirm_password','eye2')">
<i class="bi bi-eye" id="eye2"></i>
</span>
</div>
@error('password_confirmation')
    <span class="text-danger small">{{ $message }}</span>
@enderror
</div>

<!-- Submit Button -->
<button type="submit" class="btn btn-success w-100">Register</button>

<div class="text-center mt-3">
<a href="{{ route('login') }}">Already registered? Login here</a>
</div>
</form>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId, iconId) {
    let field = document.getElementById(fieldId);
    let icon = document.getElementById(iconId);

    if(field.type === "password") {
        field.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        field.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

</body>
</html>