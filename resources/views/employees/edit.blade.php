@extends('layouts')

@section('content')
    <div class="container">
        <h1>Edit Employee</h1>
        <div class="navigationButton">
            <a href="{{ route('index') }}" ><button class="icon-prev"></button></a>
        </div>

        @include('partials.sessionMessages')

        <form method="post" action="{{ route('update-employee', ['id' => $employee->id]) }}">
            @csrf
            <div class="input-group">
                <span class="append">Name:</span>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>

            <div class="input-group">
                <span class="append">Password:</span>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password', $employee->password) }}" required>
            </div>

            <div class="input-group">
                <span class="append">Designation:</span>
                <select name="designation_id" id="designation_id" class="form-control" required>
                    <option value="" selected disabled>Select Designation</option>
                    @foreach($designations as $designation)
                        <option value="{{ $designation->id }}" {{ old('designation_id', $employee->designation_id) == $designation->id ? 'selected' : '' }}>
                            {{ $designation->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
