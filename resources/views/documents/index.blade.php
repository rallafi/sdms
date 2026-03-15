@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4 text-primary">Document Search</h1>

    {{-- Search and filter form --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Search & Filter
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('documents.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search by Title</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Enter title keyword" value="{{ old('search', $search) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="categoryId" class="form-label">Category</label>
                        <select name="categoryId" id="categoryId" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>   
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="me-2">
                            <button type="submit" class="btn btn-primary">
                                Search / Filter
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Documents table --}}
    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>All Documents</span>
            <span class="badge bg-info">
                Total: {{ $documents->total() }}
            </span>
        </div>
        <div class="card-body p-0">
            @if($documents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 25%;">Title</th>
                                <th style="width: 20%;">Category</th>
                                <th style="width: 20%;">Uploaded By</th>
                                <th style="width: 15%;">Reserved Status</th>
                                <th style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{ $document->id }}</td>
                                    <td>{{ $document->title }}</td>
                                    <td>{{ $document->category ? $document->category->name : 'No Category' }}</td>
                                    <td>
                                        {{ $document->uploader ? $document->uploader->name : 'Unknown User' }}
                                    </td>
                                    <td>
                                        @if($document->is_reserved)
                                            <span class="badge bg-danger"><i class="bi bi-lock-fill"></i> Reserved</span>
                                            @if($document->activeReservation && $document->activeReservation->user)
                                                <br><small class="text-muted">by {{ $document->activeReservation->user->name }}</small>
                                            @endif
                                        @else
                                            <span class="badge bg-success"><i class="bi bi-unlock"></i> Available</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-primary mb-1" title="View">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-success mb-1" title="Download">
                                            <i class="bi bi-download"></i> Download
                                        </a>
                                        @php
                                            $canReserve = $currentUser && $currentUser->role && $currentUser->role->name !== 'supervisor';
                                            $reservedByMe = $document->activeReservation && (int) $document->activeReservation->user_id === (int) $currentUser?->id;
                                            $canEdit = $canReserve && $reservedByMe;
                                        @endphp
                                        @if($canReserve)
                                            @if(!$document->is_reserved)
                                                <form action="{{ route('documents.reserve', $document->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning mb-1" title="Reserve">
                                                        <i class="bi bi-lock"></i> Reserve
                                                    </button>
                                                </form>
                                            @elseif($reservedByMe)
                                                <form action="{{ route('documents.release', $document->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning mb-1" title="Release">
                                                        <i class="bi bi-unlock"></i> Release
                                                    </button>
                                                </form>
                                            @else
                                                <span class="btn btn-sm btn-secondary disabled mb-1" title="Reserved by another user">
                                                    <i class="bi bi-lock-fill"></i> Unavailable
                                                </span>
                                            @endif

                                            @if($canEdit)
                                                <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-outline-primary mb-1" title="Edit">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-3">
                    <p class="mb-0 text-muted">No documents found. Try changing your search or filter.</p>
                </div>
            @endif
        </div>
        @if($documents->hasPages())
            <div class="card-footer">
                {{-- Simple pagination links --}}
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

