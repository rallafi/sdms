@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-2 text-primary">
        <i class="bi bi-pencil-square"></i> Edit Document
    </h1>
    <p class="text-muted mb-4">
        Update the document details.
    </p>

    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-file-earmark-text"></i> Document Information</span>
            <span>
                @if($document->is_reserved)
                    <span class="badge bg-danger"><i class="bi bi-lock-fill"></i> Reserved</span>
                @else
                    <span class="badge bg-success"><i class="bi bi-unlock"></i> Available</span>
                @endif
            </span>
        </div>
        <div class="card-body">
            {{-- Validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i> Please fix the following issues:
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Small reservation info --}}
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                This document is currently
                @if($document->is_reserved)
                    reserved for editing.
                @else
                    not reserved. Editing should only be done when reserved.
                @endif
            </div>

            <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">
                        <i class="bi bi-type"></i> Title
                    </label>
                    <input
                    type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $document->title) }}" required>
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        <i class="bi bi-folder"></i> Category
                    </label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">
                        <i class="bi bi-card-text"></i> Description (optional)
                    </label>
                    <textarea
                    name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Short description about this document">{{ old('description', $document->description) }}
                    </textarea>
                </div>

                {{-- Current file info --}}
                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-paperclip"></i> Current File
                    </label>
                    <div class="form-text mb-1">
                        File name: <strong>{{ $document->file_name }}</strong>
                    </div>
                    <div class="form-text">
                        Type: {{ $document->file_type ?? 'Unknown' }} |
                        Size: {{ $document->file_size ? number_format($document->file_size) . ' bytes' : 'Unknown' }}
                    </div>
                </div>

                {{-- Optional new file --}}
                <div class="mb-3">
                    <label for="document_file" class="form-label">
                        <i class="bi bi-cloud-arrow-up"></i> Replace File (optional)
                    </label>
                    <input type="file" name="document_file" id="document_file" class="form-control @error('document_file') is-invalid @enderror">
                        type="file"
                    <div class="form-text">
                        Allowed types: PDF, DOC, DOCX. Max size: 2 MB.
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('documents.show', $document->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Details
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

