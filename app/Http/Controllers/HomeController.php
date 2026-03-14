<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Document;
use Inertia\Inertia;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    //

    public function index()
    {
        return \Inertia\Inertia::render('Department/Welcome', [
            // Removed the 'status' filter so it actually finds your posts
            'latestPosts' => \App\Models\Post::with(['category', 'media'])
                ->latest()
                ->take(3)
                ->get()
                ->map(fn($post) => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'category' => $post->category ? $post->category->name : 'Uncategorized',
                    // THIS MUST SAY 'image', NOT 'featured_image'
                    'image' => $post->getFirstMediaUrl('featured_image') ?: $post->getFirstMediaUrl(),
                ]),

            // Fetch 5 latest documents
            'latestDocuments' => \App\Models\Document::latest('published_date')
                ->take(5)
                ->get(),
        ]);
    }
}
