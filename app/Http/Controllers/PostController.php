<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the news posts.
     */
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'media'])
            ->latest()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            })
            ->get()
            ->map(function ($post) {
                // Remove figures (Trix image attachments) completely to hide filenames from the excerpt
                $cleanContent = preg_replace('/<figure\b[^>]*>.*?<\/figure>/is', '', $post->content);
                $cleanExcerpt = str(strip_tags($cleanContent))->limit(120);

                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content_excerpt' => (string) $cleanExcerpt,
                    'category' => $post->category ? $post->category->name : 'Uncategorized',
                    // This fetches the image from Spatie Media Library
                    'featured_image_url' => $post->getFirstMediaUrl('featured_image', 'thumb') ?: $post->getFirstMediaUrl('featured_image'),
                    'created_at' => $post->created_at->format('M d, Y'),
                ];
            });

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Display the specific news post.
     */
    public function show(Post $post)
    {
        // Load relationships for the single view
        $post->load(['category', 'media']);

        return Inertia::render('Posts/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'category' => $post->category ? $post->category->name : 'Uncategorized',
                'featured_image_url' => $post->getFirstMediaUrl('featured_image'),
                'created_at' => $post->created_at->format('F d, Y'),
            ]
        ]);
    }
}
