<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    /**
     * Display the list of published news with categories and media.
     */
    public function index(): Response
    {
        $posts = Post::with('category')
            ->where('status', 'published')
            ->latest('published_at')
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'excerpt' => $post->excerpt,
                    'category' => $post->category,
                    // Retrieves the media URL from Spatie Media Library
                    'image' => $post->getFirstMediaUrl('posts'),
                    'created_at' => $post->published_at,
                ];
            });

        return Inertia::render('News/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Display a single news post.
     */
    public function show(Post $post): Response
    {
        // We load the media URL for the show page too
        return Inertia::render('News/Show', [
            'post' => array_merge($post->toArray(), [
                'image' => $post->getFirstMediaUrl('posts'),
                'category' => $post->category?->name
            ])
        ]);
    }
}
