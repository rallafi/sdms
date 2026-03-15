@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Login
            </div>

            <div class="card-body">
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login and Send OTP</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('register') }}">Create new account</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection