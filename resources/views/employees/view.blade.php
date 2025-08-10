@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Employee Details</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $employee->name }}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Phone:</strong> {{ $employee->phone ?? '-' }}</p>
                <p><strong>Department:</strong> {{ $employee->department->name ?? '-' }}</p>
                <p><strong>Joining Date:</strong> {{ $employee->joining_date ? $employee->joining_date->format('d M Y') : '-' }}</p>
                <p><strong>Role:</strong> {{ optional($employee->user->roles->first())->name ?? '-' }}</p>
            </div>
        </div>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Back to list</a>
    </div>
@endsection
