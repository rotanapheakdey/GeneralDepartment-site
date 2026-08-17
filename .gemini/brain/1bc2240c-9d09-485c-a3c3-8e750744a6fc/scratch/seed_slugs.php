<?php
// Seed slugs for all existing posts that don't have one
use App\Models\Post;
use Illuminate\Support\Str;

$posts = Post::whereNull('slug')->orWhere('slug', '')->get();

foreach ($posts as $post) {
    $base = Str::slug($post->title);
    if (empty($base)) {
        // Fallback for Khmer titles: use ID
        $base = 'post-' . substr($post->id, 0, 8);
    }
    
    $slug = $base;
    $counter = 1;
    while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
        $slug = $base . '-' . $counter;
        $counter++;
    }

    // Calculate read time (~200 words per minute)
    $plainText = strip_tags($post->content);
    $wordCount = str_word_count($plainText);
    $readTime = max(1, (int) ceil($wordCount / 200));
    
    Post::withoutEvents(function () use ($post, $slug, $readTime) {
        $post->update([
            'slug' => $slug,
            'read_time' => $readTime,
            'workflow_status' => $post->status === 'published' ? 'published' : ($post->status === 'archived' ? 'archived' : 'draft'),
        ]);
    });
    
    echo "Updated: {$post->title} → {$slug} (read_time: {$readTime}min)\n";
}

echo "Done! Updated " . count($posts) . " posts.\n";
