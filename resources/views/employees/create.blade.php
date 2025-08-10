@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Employee</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" name="email" autocomplete="new-email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>

            <div class="mb-3">
                <label>Department <span class="text-danger">*</span></label>
                <select name="department_id" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Joining Date <span class="text-danger">*</span></label>
                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}" required>
            </div>

            <div class="mb-3">
                <label>Role <span class="text-danger">*</span></label>
                <select name="role" class="form-control" required>
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input type="password" name="password" autocomplete="new-password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirm Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create Employee</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
