@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Department</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Department Code</label>
                <input type="text" name="code" id="code" value="{{ old('code', $department->code) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $department->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Department</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
