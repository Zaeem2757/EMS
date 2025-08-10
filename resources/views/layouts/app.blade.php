<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>EMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ddd;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-white text-center mb-4">EMS</h4>
    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    @can("view department")<a href="{{ route('departments.index') }}">🏢 Departments</a>@endcan
    @can("view employee")<a href="{{ route('employees.index') }}">👥 Employees</a>@endcan
    @role("Admin")<a href="{{ route('permissions.index') }}">🔐 Permissions</a>@endrole
    @role("Admin")<a href="{{ route('roles.index') }}">👤 Roles</a>@endrole
    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-danger w-100">Logout</button>
    </form>
</div>

<!-- Main Content -->
<div class="content">
    @yield('content')
</div>

</body>
</html>
