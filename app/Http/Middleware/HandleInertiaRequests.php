<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Grab the current language to set a default "text" value
        $locale = app()->getLocale();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            // UPDATED: Now we grab the image URLs and format the text
            'settings' => Setting::all()->mapWithKeys(function ($setting) use ($locale) {
                return [$setting->key => [
                    // Provide the active text for our Vue templates
                    'text' => $locale === 'en' ? $setting->value_en : $setting->value_km,

                    // Keep the raw languages just in case
                    'km' => $setting->value_km,
                    'en' => $setting->value_en,

                    // Grab the image URL if the admin uploaded one!
                    'image_url' => $setting->getFirstMediaUrl('settings_media') ?: null,
                ]];
            })->toArray(), // Added ->toArray() to prevent Inertia rendering bugs
        ];
    }
}
