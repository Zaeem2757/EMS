@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>EMS Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h4>Welcome, {{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()->first() }})</h4>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
    <hr>
    <p>You are logged in to the EMS system.</p>
</div>
</body>
</html>
@endsection
