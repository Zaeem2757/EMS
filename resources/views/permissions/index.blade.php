@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Permissions</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   {{-- <a href="{{ route('permissions.create') }}" class="btn btn-success mb-3">Add Permission</a>--}}

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Guard Name</th>
            <th>Created At</th>
            {{--<th>Actions</th>--}}
        </tr>
        </thead>
        <tbody>
        @forelse($permissions as $index => $permission)
        <tr>
            <td>{{ $permissions->firstItem() + $index }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->guard_name }}</td>
            <td>{{ $permission->created_at->format('d M Y') }}</td>
            {{--<td>
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure to delete this permission?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </td>--}}
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No permissions found.</td>
        </tr>
        @endforelse
        </tbody>
    </table>

    {{ $permissions->links() }}
</div>
@endsection
