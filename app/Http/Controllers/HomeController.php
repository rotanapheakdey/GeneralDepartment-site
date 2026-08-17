<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Document;
use App\Models\Banner;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return \Inertia\Inertia::render('Department/Welcome', [
            'banners' => \App\Models\Banner::where('is_active', true)
                ->orderBy('order', 'asc')
                ->get(),
            
            'latestPosts' => \App\Models\Post::with(['category', 'media'])
                ->where('status', 'published')
                ->latest('published_at')
                ->take(6)
                ->get()
                ->map(fn($post) => [
                    'id'         => $post->id,
                    'slug'       => $post->slug,
                    'title'      => $post->title,
                    'category'   => $post->category ? $post->category->name : 'Uncategorized',
                    'image'      => $post->featured_image_url,
                    'is_breaking'=> $post->is_breaking,
                    'read_time'  => $post->read_time,
                    'created_at' => \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('M d, Y'),
                ]),

            // Fetch 5 latest documents
            'latestDocuments' => \App\Models\Document::latest('published_date')
                ->take(5)
                ->get(),
        ]);
    }
}
