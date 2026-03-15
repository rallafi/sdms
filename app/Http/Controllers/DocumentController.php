<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\ActivityLog;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController
{
    /**
     * Show list of documents with search and filter.
     */
    public function index(Request $request)
    {
        // Get search text and category from request
        $search = $request->input('search');
        $categoryId = $request->input('categoryId');

        // Start a document query and load relationships
        $query = Document::with(['category', 'uploader', 'activeReservation.user']);

        // Filter by title if search value is given
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Filter by category if categoryId is given
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        // Order by latest created document
        $documents = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // Keep search/filter in pagination links

        // Get all categories for the dropdown
        $categories = Category::orderBy('name')->get();

        // Return view with data and current user for Reserve/Release buttons
        return view('documents.index', [
            'documents' => $documents,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId,
            'currentUser' => Auth::user(),
        ]);
    }

    /**
     * Show a single document details page.
     */
    public function show($id)
    {
        // Find document with relationships (including active reservation) or fail with 404
        $document = Document::with(['category', 'uploader', 'lastEditor', 'activeReservation.user'])->findOrFail($id);

        // Return view with document and current user for Reserve/Release buttons
        return view('documents.show', [
            'document' => $document,
            'currentUser' => Auth::user(),
        ]);
    }

    /**
     * Show the upload document form.
     */
    public function create()
    {
        $user = Auth::user();

        // Supervisor should not upload
        if ($user && $user->role && strtolower($user->role->name) === 'supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to upload documents.');
        }

        // Load categories for dropdown
        $categories = Category::orderBy('name')->get();

        return view('documents.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Handle upload document form submit.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Supervisor should not upload
        if ($user && $user->role && strtolower($user->role->name) === 'supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to upload documents.');
        }

        // Validate upload input 
        $validatedData = $this->validateDocumentUpload($request);

        // Get uploaded file
        $file = $request->file('document_file');

        // Store file in "documents" folder in local storage and return the path
        $storedPath = $file->store('documents');

        // Prepare file details
        $originalName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $fileType = $file->getClientMimeType();

        // Create document record in database
        $document = Document::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'category_id' => $validatedData['category_id'],
            'file_name' => $originalName,
            'file_path' => $storedPath,
            'file_size' => $fileSize,
            'file_type' => $fileType,
            'uploaded_by' => $user->id,
            'last_edited_by' => $user->id,
            'is_reserved' => false,
        ]);

        // Save simple activity log for the upload
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'upload_document',
            'description' => 'Document "' . $document->title . '" uploaded successfully.',
            'ip_address' => $request->ip(),
        ]);

        // Redirect to documents list with success message
        return redirect()
            ->route('documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Download document file.
     */
    public function download(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        // Check if file exists in storage
        if (!$document->file_path || !Storage::exists($document->file_path)) {
            return redirect()->back()->with('error', 'Document file is missing and cannot be downloaded.');
        }

        // Log download activity
        $ipAddress = $request->ip();
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'download_document',
            'description' => 'Document "' . $document->title . '" downloaded successfully.',
            'ip_address' => $ipAddress,
        ]);

        // Download with original file name if available
        $downloadName = $document->file_name ?: basename($document->file_path);

        return Storage::download($document->file_path, $downloadName);
    }

    /**
     * Reserve a document for editing. Engineer and manager only; one active reservation per document.
     */
    public function reserve(Request $request, $id)
    {
        $user = Auth::user();
        $document = Document::findOrFail($id);

        // Supervisor should not reserve
        if ($user && $user->role && strtolower($user->role->name) === 'supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to reserve documents.');
        }

        // Check for existing active reservation
        $activeReservation = Reservation::where('document_id', $document->id)
            ->where('status', 'active')
            ->first();

        if ($activeReservation) {
            if ((int) $activeReservation->user_id === (int) $user->id) {
                return redirect()->back()->with('info', 'You have already reserved this document.');
            }
            return redirect()->back()->with('error', 'This document is already reserved by another user.');
        }

        // Create reservation
        Reservation::create([
            'document_id' => $document->id,
            'user_id' => $user->id,
            'reserved_at' => now(),
            'status' => 'active',
        ]);

        // Update document
        $document->is_reserved = true;
        $document->save();

        // Activity log
        $ipAddress = $request->ip();
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'reserve_document',
            'description' => 'Document "' . $document->title . '" reserved successfully.',
            'ip_address' => $ipAddress,
        ]);

        return redirect()->back()->with('success', 'Document reserved successfully.');
    }

    /**
     * Release reservation. Only the user who reserved it can release.
     */
    public function release(Request $request, $id)
    {
        $user = Auth::user();
        $document = Document::findOrFail($id);

        $activeReservation = Reservation::where('document_id', $document->id)
            ->where('status', 'active')
            ->first();

        if (!$activeReservation) {
            return redirect()->back()->with('error', 'No active reservation found for this document.');
        }

        if ((int) $activeReservation->user_id !== (int) $user->id) {
            return redirect()->back()->with('error', 'Only the user who reserved this document can release it.');
        }

        // Update reservation
        $activeReservation->released_at = now();
        $activeReservation->status = 'released';
        $activeReservation->save();

        // Update document
        $document->is_reserved = false;
        $document->last_edited_by = $user->id;
        $document->save();

        // Activity log
        $ipAddress = $request->ip();
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'release_document',
            'description' => 'Document "' . $document->title . '" reservation released successfully.',
            'ip_address' => $ipAddress,
        ]);

        return redirect()->back()->with('success', 'Reservation released successfully.');
    }

    /**
     * Show the edit document form.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $document = Document::with(['category', 'activeReservation'])->findOrFail($id);

        // Supervisor should not edit
        if ($user && $user->role && strtolower($user->role->name) === 'supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to edit documents.');
        }

        // Find active reservation for this document
        $activeReservation = Reservation::where('document_id', $document->id)
            ->where('status', 'active')
            ->first();

        if (!$activeReservation) {
            return redirect()->back()->with('error', 'Please reserve this document before editing.');
        }

        if ((int) $activeReservation->user_id !== (int) $user->id) {
            return redirect()->back()->with('error', 'This document is reserved by another user. You cannot edit it.');
        }

        $categories = Category::orderBy('name')->get();

        return view('documents.edit', [
            'document' => $document,
            'categories' => $categories,
        ]);
    }

    /**
     * Handle edit document form submit.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $document = Document::findOrFail($id);

        // Supervisor should not edit
        if ($user && $user->role && strtolower($user->role->name) === 'supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to edit documents.');
        }

        // Check active reservation
        $activeReservation = Reservation::where('document_id', $document->id)
            ->where('status', 'active')
            ->first();

        if (!$activeReservation) {
            return redirect()->back()->with('error', 'Please reserve this document before editing.');
        }

        if ((int) $activeReservation->user_id !== (int) $user->id) {
            return redirect()->back()->with('error', 'This document is reserved by another user. You cannot edit it.');
        }

        // Validation rules for edit
        $validatedData = $this->validateDocumentUpdate($request);

        // Update simple fields
        $document->title = $validatedData['title'];
        $document->category_id = $validatedData['category_id'];
        $document->description = $validatedData['description'] ?? null;

        // Handle optional new file
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');

            // Optionally delete old file if it exists
            if ($document->file_path && Storage::exists($document->file_path)) {
                Storage::delete($document->file_path);
            }

            // Store new file
            $storedPath = $file->store('documents');
            $document->file_name = $file->getClientOriginalName();
            $document->file_path = $storedPath;
            $document->file_size = $file->getSize();
            $document->file_type = $file->getClientMimeType();
        }

        // Update last editor
        $document->last_edited_by = $user->id;
        $document->save();

        // Log edit activity
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'edit_document',
            'description' => 'Document "' . $document->title . '" updated successfully.',
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('documents.show', $document->id)
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Validation rules for new document upload.
     */
    private function validateDocumentUpload(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'document_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
    }

    /**
     * Validation rules for document update.
     */
    private function validateDocumentUpdate(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
    }
}