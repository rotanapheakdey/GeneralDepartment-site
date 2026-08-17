#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;

$posts = Post::where('status','published')->take(3)->get(['id','slug','title','read_time','views_count','is_breaking']);
echo json_encode($posts->toArray(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
