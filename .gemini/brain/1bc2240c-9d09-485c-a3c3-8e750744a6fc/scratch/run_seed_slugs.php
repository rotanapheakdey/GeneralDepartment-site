#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;
use Illuminate\Support\Str;

$posts = Post::whereNull('slug')->orWhere('slug', '')->get();

foreach ($posts as $post) {
    $base = Str::slug($post->title);
    if (empty($base)) {
        $base = 'post-' . substr($post->id, 0, 8);
    }
    
    $slug = $base;
    $counter = 1;
    while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
        $slug = $base . '-' . $counter;
        $counter++;
    }

    $plainText = strip_tags($post->content ?? '');
    $wordCount = str_word_count($plainText);
    $readTime = max(1, (int) ceil($wordCount / 200));
    
    $post->timestamps = false;
    $post->slug = $slug;
    $post->read_time = $readTime;
    $post->workflow_status = match($post->status) {
        'published' => 'published',
        'archived'  => 'archived',
        default     => 'draft',
    };
    $post->saveQuietly();
    
    echo "✓ " . mb_substr($post->title, 0, 50) . " → {$slug} ({$readTime}min)\n";
}

echo "\nDone! Updated " . count($posts) . " posts.\n";
