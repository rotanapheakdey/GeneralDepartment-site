<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        // 1. Fetch all unique, non-empty document types directly from the database
        $types = Document::select('document_type')
            ->whereNotNull('document_type')
            ->where('document_type', '!=', '')
            ->distinct()
            ->pluck('document_type');

        // 2. The Main Query
        $documents = Document::query()
            // Filter by Search (Title)
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            // Filter by Type Dropdown
            ->when($request->type, function ($query, $type) {
                $query->where('document_type', $type);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn($doc) => [
                'id' => $doc->id,
                'title' => $doc->title,
                'document_type' => $doc->document_type,
                'file_url' => $doc->file_path ? Storage::url($doc->file_path) : null,
                'published_date' => $doc->published_date,
            ]);

        return Inertia::render('Documents/Index', [
            'documents' => $documents,
            'types' => $types, // Pass the dynamic types to Vue
            'filters' => $request->only(['search', 'type']) // Remember both filters
        ]);
    }
}
