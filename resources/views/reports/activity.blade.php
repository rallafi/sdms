@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-2 text-primary">
        <i class="bi bi-clipboard-data"></i> Activity Reports
    </h1>
    <p class="text-muted mb-4">
        View and filter user activity logs in SDMS.
    </p>

    {{-- Summary cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="bi bi-list-check fs-3"></i>
                    </div>
                    <h6 class="mb-1">Total Logs</h6>
                    <div class="fs-4 fw-bold">{{ $totalLogs }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="bi bi-cloud-arrow-up fs-3"></i>
                    </div>
                    <h6 class="mb-1">Uploads</h6>
                    <div class="fs-4 fw-bold">{{ $totalUploads }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="bi bi-download fs-3"></i>
                    </div>
                    <h6 class="mb-1">Downloads</h6>
                    <div class="fs-4 fw-bold">{{ $totalDownloads }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="bi bi-pencil-square fs-3"></i>
                    </div>
                    <h6 class="mb-1">Edits</h6>
                    <div class="fs-4 fw-bold">{{ $totalEdits }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter form --}}
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-funnel"></i> Filter Activity Logs
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('reports.activity') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="userId" class="form-label">User</label>
                        <select name="userId" id="userId" class="form-select">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($userId == $user->id) selected @endif>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="action" class="form-label">Action</label>
                        <select name="action" id="action" class="form-select">
                            <option value="">All Actions</option>
                            @foreach($actions as $singleAction)
                                <option value="{{ $singleAction }}" @if($actionFilter == $singleAction) selected @endif>
                                    {{ $singleAction }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="dateFrom" class="form-label">Date From</label>
                        <input type="date" name="dateFrom" id="dateFrom" class="form-control" value="{{ $dateFrom }}">
                    </div>
                    <div class="col-md-2">
                        <label for="dateTo" class="form-label">Date To</label>
                        <input type="date" name="dateTo" id="dateTo" class="form-control" value="{{ $dateTo }}">
                    </div>
                    <div class="col-md-2 d-flex">
                        <div class="me-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Filter
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('reports.activity') }}" class="btn btn-secondary w-100">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Activity logs table --}}
    <div class="card">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-journal-text"></i> Activity Logs</span>
            <span class="badge bg-light text-dark">
                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} record(s)
            </span>
        </div>
        <div class="card-body p-0">
            @if($logs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 15%;">User</th>
                                <th style="width: 15%;">Action</th>
                                <th style="width: 35%;">Description</th>
                                <th style="width: 15%;">IP Address</th>
                                <th style="width: 15%;">Date &amp; Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->user ? $log->user->name : 'Unknown' }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->ip_address ?? 'N/A' }}</td>
                                    <td>{{ $log->created_at ? $log->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-3">
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i> No activity logs found for the selected filters.
                    </div>
                </div>
            @endif
        </div>
        @if($logs->hasPages())
            <div class="card-footer">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

