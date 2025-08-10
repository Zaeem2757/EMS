@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <h2 class="">Employees</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{ route('employees.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            @role("Admin")<a href="{{ route('employees.create') }}" class="btn btn-primary">+ Create Employee</a>@endrole

        </div>





        {{-- Table --}}
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Joining Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') }}</td>
                    <td>
                        @can("view employee")<a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>@endcan
                        @can("edit employee")<a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>@endcan
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            @can("delete employee")<button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>@endcan
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No employees found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
