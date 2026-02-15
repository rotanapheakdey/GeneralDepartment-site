<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('News/Index', [
            'posts' => Post::where('status', 'published')
                ->latest('published_at')
                ->get()
        ]);
    }

    public function show(Post $post): Response
    {
        return Inertia::render('News/Show', [
            'post' => $post
        ]);
    }
}
