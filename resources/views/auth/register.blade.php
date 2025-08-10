<!DOCTYPE html>
<html>
<head>
    <title>EMS Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <h3 class="text-center">EMS Register</h3>
        <form method="POST" action="{{ url('/register') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
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
            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Manager">Manager</option>
                    <option value="Employee">Employee</option>
                </select>
                @error('role') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button class="btn btn-success w-100">Register</button>
        </form>
        <p class="mt-3 text-center">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
</div>
</body>
</html>
