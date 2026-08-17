#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use Illuminate\Support\Str;

$categories = Category::whereNull('slug')->orWhere('slug', '')->get();

foreach ($categories as $category) {
    $base = Str::slug($category->name);
    if (empty($base)) {
        $base = 'category-' . substr($category->id, 0, 8);
    }
    
    $slug = $base;
    $counter = 1;
    while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
        $slug = $base . '-' . $counter;
        $counter++;
    }

    $category->slug = $slug;
    $category->saveQuietly();
    echo "✓ " . $category->name . " → {$slug}\n";
}

echo "\nDone! Updated " . count($categories) . " categories.\n";
