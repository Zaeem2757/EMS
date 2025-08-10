@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Roles</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{--<a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Add Role</a>--}}

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
            @forelse($roles as $index => $role)
                <tr>
                    <td>{{ $roles->firstItem() + $index }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>{{ $role->created_at->format('d M Y') }}</td>
                    {{--<td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure to delete this role?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>--}}
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No roles found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $roles->links() }}
    </div>
@endsection
