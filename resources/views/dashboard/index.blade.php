@extends('layouts.app')

@section('content')
<div class="row g-4">

    <!-- Welcome Section -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body bg-primary text-white rounded">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Welcome, {{ auth()->user()->name }}
                        </h2>
                        <p class="mb-0">
                            Secure Document Management System dashboard.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="badge bg-light text-dark px-3 py-2 fs-6">
                            {{ ucfirst(auth()->user()->role->name) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Info Cards -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded p-3 me-3">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Email Address</h6>
                        <p class="mb-0 text-muted">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success text-white rounded p-3 me-3">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Your Role</h6>
                        <p class="mb-0 text-muted">{{ ucfirst(auth()->user()->role->name) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning text-dark rounded p-3 me-3">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Last Login</h6>
                        <p class="mb-0 text-muted">
                            {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d M Y, h:i A') : 'First login' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Summary -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-person-circle me-2"></i>
                Profile Summary
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Full Name</div>
                    <div class="col-sm-8">{{ auth()->user()->name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Email</div>
                    <div class="col-sm-8">{{ auth()->user()->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Role</div>
                    <div class="col-sm-8">{{ ucfirst(auth()->user()->role->name) }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-4 fw-bold">Last Login</div>
                    <div class="col-sm-8">
                        {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d M Y, h:i A') : 'First login' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-secondary text-white">
                <i class="bi bi-lightning-charge-fill me-2"></i>
                Quick Actions
            </div>
            <div class="card-body d-grid gap-2">
                @if(Route::has('documents.index'))
                    <a href="{{ route('documents.index') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                        <i class="bi bi-folder2-open me-2"></i>
                        Open Documents
                    </a>
                    <a href="{{ route('documents.create') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                        <i class="bi bi-cloud-arrow-up me-2"></i>
                        Upload Document
                    </a>
                @endif

                @if(auth()->user()->role->name === 'supervisor')
                    <a href="{{ route('reports.activity') }}" class="btn btn-outline-dark d-flex align-items-center justify-content-center">
                        <i class="bi bi-clipboard-data me-2"></i>
                        Activity Reports
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection