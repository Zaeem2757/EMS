<!DOCTYPE html>
<html>
<head>
    <title>EMS Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <h3 class="text-center">EMS Login</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
</div>
</body>
</html>
