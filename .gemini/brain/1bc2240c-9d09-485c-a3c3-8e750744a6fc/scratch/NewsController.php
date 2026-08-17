<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsController extends Controller
{
    /**
     * Display the list of published news with categories, search, and filter.
     * N+1 FIX: eager-load media so featured_image_url accessor avoids extra queries.
     */
    public function index(Request $request): Response
    {
        $categories = Category::orderBy('name')->get(['id', 'name', 'slug']);

        $posts = Post::with(['category', 'media'])
            ->published()
            ->when($request->search, fn ($q, $s) =>
                $q->where('title', 'like', "%{$s}%")
            )
            ->when($request->category, fn ($q, $cat) =>
                $q->whereHas('category', fn ($cq) => $cq->where('slug', $cat))
            )
            ->when($request->sort === 'views', fn ($q) =>
                $q->orderByDesc('views_count')
            , fn ($q) =>
                $q->latest('published_at')
            )
            ->paginate(9)
            ->withQueryString()
            ->through(fn ($post) => [
                'id'         => $post->id,
                'slug'       => $post->slug,
                'title'      => $post->title,
                'excerpt'    => $post->excerpt,
                'category'   => $post->category ? ['name' => $post->category->name, 'slug' => $post->category->slug] : null,
                'image'      => $post->featured_image_url,
                'read_time'  => $post->read_time,
                'is_breaking'=> $post->is_breaking,
                'is_featured'=> $post->is_featured,
                'created_at' => $post->published_at
                    ? Carbon::parse($post->published_at)->format('M d, Y')
                    : Carbon::parse($post->created_at)->format('M d, Y'),
            ]);

        return Inertia::render('News/Index', [
            'posts'      => $posts,
            'categories' => $categories,
            'filters'    => $request->only(['search', 'category', 'sort']),
        ]);
    }

    /**
     * Display a single news post by slug.
     * N+1 FIX: use ->with() for all relationships up front.
     */
    public function show(Post $post): Response
    {
        // Load all needed relationships in one batch
        $post->load(['category', 'media', 'creator']);

        // Increment view counter asynchronously-style
        $post->incrementViews();

        // Recent posts — eager-load media to fix N+1 in sidebar
        $recentPosts = Post::with(['category', 'media'])
            ->published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(5)
            ->get()
            ->map(fn ($p) => [
                'id'        => $p->id,
                'slug'      => $p->slug,
                'title'     => $p->title,
                'category'  => $p->category?->name ?? 'General News',
                'image'     => $p->featured_image_url,
                'read_time' => $p->read_time,
                'created_at'=> Carbon::parse($p->published_at ?? $p->created_at)->format('M d, Y'),
            ]);

        // Build Schema.org JSON-LD
        $jsonLd = [
            '@context'         => 'https://schema.org',
            '@type'            => 'NewsArticle',
            'headline'         => $post->effective_seo_title,
            'description'      => $post->effective_seo_description,
            'image'            => $post->featured_image_url,
            'datePublished'    => optional($post->published_at)->toIso8601String(),
            'dateModified'     => $post->updated_at->toIso8601String(),
            'author'           => [
                '@type' => 'Organization',
                'name'  => 'Ministry of Information, Cambodia',
            ],
            'publisher'        => [
                '@type' => 'Organization',
                'name'  => 'Ministry of Information, Cambodia',
                'logo'  => ['@type' => 'ImageObject', 'url' => asset('images/logo.png')],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id'   => route('news.show', $post->slug),
            ],
        ];

        return Inertia::render('News/Show', [
            'post' => [
                'id'               => $post->id,
                'slug'             => $post->slug,
                'title'            => $post->title,
                'content'          => $post->content,
                'excerpt'          => $post->excerpt,
                'category'         => $post->category?->name ?? 'General News',
                'category_slug'    => $post->category?->slug,
                'image'            => $post->featured_image_url,
                'read_time'        => $post->read_time,
                'views_count'      => $post->views_count,
                'source_credit'    => $post->source_credit,
                'is_breaking'      => $post->is_breaking,
                'seo_title'        => $post->effective_seo_title,
                'seo_description'  => $post->effective_seo_description,
                'created_at'       => Carbon::parse($post->published_at ?? $post->created_at)->format('M d, Y'),
                'created_at_iso'   => optional($post->published_at)->toIso8601String(),
            ],
            'recentPosts' => $recentPosts,
            'jsonLd'      => $jsonLd,
        ]);
    }
}
