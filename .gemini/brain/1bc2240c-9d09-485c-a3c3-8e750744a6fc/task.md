# Dynamic Media Links Implementation Tasks

## Database & Models
- `[x]` Create `MediaLink` migration (`name_en`, `name_km`, `url`, `is_active`, `sort_order`).
- `[x]` Update `MediaLink` model with `InteractsWithMedia` trait.
- `[x]` Run `php artisan migrate`.

## Filament Backend
- `[x]` Generate `MediaLinkResource` using artisan.
- `[x]` Configure `MediaLinkResource` form (TextInput for names, URL, Toggle for is_active, SpatieMediaLibraryFileUpload for logo).
- `[x]` Configure `MediaLinkResource` table.

## Frontend Architecture
- `[x]` Create `MediaController@index`.
- `[x]` Update `routes/web.php` to route `/media` to `MediaController@index`.
- `[x]` Create `resources/js/Pages/Media/Index.vue` with an interactive grid.
- `[x]` Update `Navbar.vue` to change "Media & Broadcasting" from a dropdown to a direct link.

## Verification
- `[x]` Build frontend assets (`npm run build`).
