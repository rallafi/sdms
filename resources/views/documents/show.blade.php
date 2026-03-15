@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4 text-primary">Document Details</h1>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>{{ $document->title }}</span>
            <span>
                @if($document->is_reserved)
                    <span class="badge bg-danger">Reserved</span>
                @else
                    <span class="badge bg-success">Available</span>
                @endif
            </span>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Title:</div>
                <div class="col-md-8">{{ $document->title }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Description:</div>
                <div class="col-md-8">
                    @if($document->description)
                        {{ $document->description }}
                    @else
                        <span class="text-muted">No description provided.</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Category:</div>
                <div class="col-md-8">
                    {{ $document->category ? $document->category->name : 'No Category' }}
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">File Name:</div>
                <div class="col-md-8">{{ $document->file_name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">File Path:</div>
                <div class="col-md-8">{{ $document->file_path }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">File Size:</div>
                <div class="col-md-8">
                    @if($document->file_size)
                        {{ number_format($document->file_size) }} bytes
                    @else
                        <span class="text-muted">Not specified</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">File Type:</div>
                <div class="col-md-8">
                    @if($document->file_type)
                        {{ $document->file_type }}
                    @else
                        <span class="text-muted">Not specified</span>
                    @endif
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Uploaded By:</div>
                <div class="col-md-8">
                    {{ $document->uploader ? $document->uploader->name : 'Unknown User' }}
                </div>
            </div>

            <hr>

            {{-- Reservation information --}}
            <h6 class="text-dark mb-2"><i class="bi bi-lock"></i> Reservation Information</h6>
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Reservation Status:</div>
                <div class="col-md-8">
                    @if($document->is_reserved)
                        <span class="badge bg-danger"><i class="bi bi-lock-fill"></i> Reserved</span>
                    @else
                        <span class="badge bg-success"><i class="bi bi-unlock"></i> Available</span>
                    @endif
                </div>
            </div>
            @if($document->is_reserved && $document->activeReservation)
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Reserved By:</div>
                    <div class="col-md-8">
                        @if($document->activeReservation->user)
                            {{ $document->activeReservation->user->name }}
                        @else
                            <span class="text-muted">Not specified</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Reserved At:</div>
                    <div class="col-md-8">
                        @if($document->activeReservation->reserved_at)
                            {{ $document->activeReservation->reserved_at->format('d M Y, h:i A') }}
                        @else
                            <span class="text-muted">Not specified</span>
                        @endif
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Last Editor:</div>
                <div class="col-md-8">
                    @if($document->lastEditor)
                        {{ $document->lastEditor->name }}
                    @else
                        <span class="text-muted">Not updated yet</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Created At:</div>
                <div class="col-md-8">
                    @if($document->created_at)
                        {{ $document->created_at->format('d M Y, h:i A') }}
                    @else
                        <span class="text-muted">Not specified</span>
                    @endif
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-4 fw-bold">Updated At:</div>
                <div class="col-md-8">
                    @if($document->updated_at)
                        {{ $document->updated_at->format('d M Y, h:i A') }}
                    @else
                        <span class="text-muted">Not specified</span>
                    @endif
                </div>
            </div>
        </div>
        @php
            $canReserve = $currentUser && $currentUser->role && $currentUser->role->name !== 'supervisor';
            $reservedByMe = $document->activeReservation && (int) $document->activeReservation->user_id === (int) ($currentUser?->id ?? 0);
        @endphp
        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Documents
                </a>
                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-success">
                    <i class="bi bi-download"></i> Download
                </a>
                @if($canReserve)
                    @if(!$document->is_reserved)
                        <form action="{{ route('documents.reserve', $document->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning"><i class="bi bi-lock"></i> Reserve</button>
                        </form>
                    @elseif($reservedByMe)
                        <form action="{{ route('documents.release', $document->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning"><i class="bi bi-unlock"></i> Release</button>
                        </form>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    @endif
                @endif
            </div>
            @if($document->is_reserved && !$reservedByMe && $document->activeReservation && $document->activeReservation->user)
                <div class="alert alert-warning mb-0 py-2 small">
                    <i class="bi bi-info-circle"></i> Reserved by {{ $document->activeReservation->user->name }}. Only they can release or edit it.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

