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
        $documents = Document::query()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
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
            'filters' => $request->only(['search'])
        ]);
    }
}
