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
        $types = Document::select('document_type')
            ->whereNotNull('document_type')
            ->where('document_type', '!=', '')
            ->distinct()
            ->pluck('document_type');

        $documents = Document::query()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
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
                'published_date' => $doc->published_date,
                'file_url' => $doc->file_url,
                'preview_url' => $doc->preview_url,
            ]);

        return Inertia::render('Documents/Index', [
            'documents' => $documents,
            'types' => $types,
            'filters' => $request->only(['search', 'type'])
        ]);
    }
}
