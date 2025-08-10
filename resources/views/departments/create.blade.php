@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Department</h2>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            {{-- Department Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="form-control"
                    placeholder="Enter department name"
                    required
                >
            </div>

            {{-- code --}}
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input
                    type="text"
                    name="code"
                    id="code"
                    value="{{ old('code') }}"
                    class="form-control"
                    placeholder="Enter department code"
                    required
                >
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    placeholder="Enter department description"
                    rows="3"
                >{{ old('description') }}</textarea>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Create Department</button>
            </div>
        </form>
    </div>
@endsection
