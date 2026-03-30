<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Carbon;

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
            ->paginate(9)
            ->through(function ($post) {
                return [
                    'id' => $post->id, // Ensure this is exactly 'id'
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'category' => $post->category,
                    // Fallback for image: if Spatie media is empty, use the dummy URL from featured_image
                    'image' => $post->getFirstMediaUrl('posts') ?: $post->featured_image,
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
        // Load the category relationship if not already loaded
        $post->load('category');

        // --- THE NEW SIDEBAR LOGIC ---
        // Fetch 4 recent published posts, excluding the one currently being viewed
        $recentPosts = Post::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $post->id) // Don't show the current article in the sidebar
            ->latest('published_at')
            ->take(4)
            ->get()
            ->map(fn($p) => [
                'id' => $p->id,
                'title' => $p->title,
                'category' => $p->category?->name ?? 'General News',
                // Consistent fallback logic
                'image' => $p->getFirstMediaUrl('posts') ?: $p->featured_image,
                'created_at' => Carbon::parse($p->published_at ?? $p->created_at)->format('M d, Y'),
            ]);

        return Inertia::render('News/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content, // The full body
                'excerpt' => $post->excerpt,
                'category' => $post->category?->name ?? 'General News',
                // Added the same fallback logic as index
                'image' => $post->getFirstMediaUrl('posts') ?: $post->featured_image,
                // Format date for a cleaner look
                'created_at' => Carbon::parse($post->published_at ?? $post->created_at)->format('M d, Y'),
            ],
            // Pass the newly fetched array to your Show.vue component
            'recentPosts' => $recentPosts,
        ]);
    }
}
