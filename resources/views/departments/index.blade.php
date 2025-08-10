@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        <h2>Departments</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{ route('departments.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            @role("Admin")<a href="{{ route('departments.create') }}" class="btn btn-primary">+ Create Department</a>@endrole
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Department Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($departments as $dept)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dept->name }}</td>
                    <td>{{ $dept->description }}</td>
                    <td>{{ $dept->created_at->format('d M Y') }}</td>
                    <td> <!-- View Button -->
                        @can("view department")<a href="{{ route('departments.show', $dept->id) }}" class="btn btn-sm btn-info">
                            View
                        </a>@endcan

                        <!-- Edit Button -->
                        @can("edit department")<a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>@endcan

                        <!-- Delete Button -->
                        <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            @can("delete department")<button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this department?');">
                                Delete
                            </button>@endcan
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No departments found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
    {{ $departments->links('pagination::bootstrap-5') }}
@endsection
