@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Department Details</h2>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $department->name }}</h5>
                <p><strong>Code:</strong> {{ $department->code }}</p>
                <p><strong>Description:</strong> {{ $department->description ?? 'No description provided.' }}</p>
            </div>
        </div>

        <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back</a>
        {{--<a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning mt-3">Edit</a>--}}
    </div>
@endsection
