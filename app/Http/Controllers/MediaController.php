<?php

namespace App\Http\Controllers;

use App\Models\MediaLink;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $links = MediaLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($link) {
                return [
                    'id' => $link->id,
                    'name_en' => $link->name_en,
                    'name_km' => $link->name_km,
                    'url' => $link->url,
                    'logo' => $link->getFirstMediaUrl('logo') ?: null,
                ];
            });

        return inertia('Media/Index', [
            'links' => $links
        ]);
    }
}
