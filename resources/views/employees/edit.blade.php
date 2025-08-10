@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Employee</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>

            <div class="mb-3">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" name="email" autocomplete="new-email" class="form-control" value="{{ old('email', $employee->email) }}" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
            </div>

            <div class="mb-3">
                <label>Department <span class="text-danger">*</span></label>
                <select name="department_id" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Joining Date <span class="text-danger">*</span></label>
                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $employee->joining_date ? $employee->joining_date->format('Y-m-d') : '') }}" required>
            </div>

            <div class="mb-3">
                <label>Role <span class="text-danger">*</span></label>
                @php
                    $currentRole = old('role') ?? ($employee->user && $employee->user->roles->isNotEmpty() ? $employee->user->roles->first()->name : '');
                @endphp
                <select name="role" class="form-control" required>
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $currentRole == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Password (leave blank to keep current)</label>
                <input type="password" name="password" autocomplete="new-password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
