@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-2 text-primary">
        <i class="bi bi-upload"></i> Upload Document
    </h1>
    <p class="text-muted mb-4">
        Use this form to upload a new engineering document into SDMS.
    </p>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-file-earmark-text"></i> Document Details
        </div>
        <div class="card-body">
            {{-- Show validation errors clearly --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">
                        <i class="bi bi-type"></i> Title
                    </label>
                    <input type="text" 
                    name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter document title" required>
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        <i class="bi bi-folder"></i> Category
                    </label>
                    <select name="category_id"
                        id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                        name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Short description about this document">{{ old('description') }}
                    </textarea>
                </div>

                {{-- Document file --}}
                <div class="mb-3">
                    <label for="document_file" class="form-label">
                        <i class="bi bi-paperclip"></i> Document File
                    </label>
                    <input type="file"
                        name="document_file" id="document_file" class="form-control @error('document_file') is-invalid @enderror" required>
                    <div class="form-text">
                        Allowed types: PDF, DOC, DOCX. Max size: 2 MB.
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Documents
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cloud-arrow-up"></i> Upload Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection