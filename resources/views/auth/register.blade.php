@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Register Account
            </div>

            <div class="card-body">
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text"
                            id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="roleName" class="form-label">Role</label>
                        <select id="roleName" name="roleName" class="form-select" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('roleName') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Create Account
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Already have an account? Login</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection