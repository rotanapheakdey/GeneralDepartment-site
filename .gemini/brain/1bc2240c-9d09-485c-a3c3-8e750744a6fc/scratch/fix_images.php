<?php

use Illuminate\Support\Facades\DB;
use App\Models\Post;

$images = [
    'https://upload.wikimedia.org/wikipedia/commons/a/ab/Angkor_Wat_from_the_moat.jpg',
    'https://upload.wikimedia.org/wikipedia/commons/2/23/Independence_Monument_Phnom_Penh.jpg',
    'https://upload.wikimedia.org/wikipedia/commons/4/43/Royal_Palace_of_Phnom_Penh.jpg',
    'https://upload.wikimedia.org/wikipedia/commons/1/1a/Phnom_Penh_skyline_2016.jpg',
    'https://upload.wikimedia.org/wikipedia/commons/8/83/Flag_of_Cambodia.svg'
];

$posts = Post::all();
$count = 0;
foreach ($posts as $post) {
    // If we inserted it previously, update it to a real image
    $post->featured_image = $images[array_rand($images)];
    $post->save();
    $count++;
}

echo "Successfully updated images for {$count} records.\n";
