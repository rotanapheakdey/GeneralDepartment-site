<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Leader;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show($slug)
    {
        if ($slug === 'leadership' || $slug === 'structure') {
            $leaders = Leader::with('media')
                ->orderBy('order')
                ->get()
                ->map(function ($leader) {
                    return [
                        'id' => $leader->id,
                        'name_en' => $leader->name_en,
                        'name_km' => $leader->name_km,
                        'role' => $leader->role,
                        'image_url' => $leader->getFirstMediaUrl('leader_images'),
                    ];
                })
                ->groupBy('role');

            return Inertia::render('Page/Show', [
                'page' => [
                    'slug' => 'leadership',
                    'title_en' => 'Leadership',
                    'title_km' => 'ថ្នាក់ដឹកនាំ',
                ],
                'leaders' => $leaders
            ]);
        }

        $page = Page::where('slug', $slug)->firstOrFail();

        return Inertia::render('Page/Show', [
            'page' => $page
        ]);
    }
}
