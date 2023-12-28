@extends('layouts')

@section('content')
    <div class="container">
        <h1>Employee Details</h1>
        <div class="navigationButton">
            <a href="{{ route('index') }}" ><button class="icon-prev"></button></a>
        </div>

        @include('partials.sessionMessages')

        <div class="card my-3">
            <div class="card-header">
                <h5>{{ $employee->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Designation:</strong> {{ $employee->designation }}</p>
            </div>
        </div>
    </div>
@endsection
