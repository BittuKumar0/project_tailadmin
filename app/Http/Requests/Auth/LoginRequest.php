<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body{
            background:#f4f6f9;
        }
        .login-card{
            max-width:400px;
            margin:80px auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
            background:#fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-card">
        <h3 class="text-center mb-4">Login</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label">Remember Me</label>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>