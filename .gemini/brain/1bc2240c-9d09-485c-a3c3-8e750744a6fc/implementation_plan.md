# Dynamic Media & Broadcasting Links Implementation

This plan outlines how we will convert the "Media & Broadcasting" navigation into a dynamic page managed through the `/admin` panel.

## Proposed Changes

### 1. Database & Model
- **New Model:** `MediaLink`
- **Migration Fields:**
  - `name_en` (English Name)
  - `name_km` (Khmer Name)
  - `url` (External Link)
  - `is_active` (Boolean, default `true` to easily hide/show links)
  - `sort_order` (Integer, default `0` for manual ordering)
- **Media Library:** Attach Spatie MediaLibrary to the `MediaLink` model to allow uploading official logos for each broadcaster or media site.

### 2. Filament Admin Panel
- **New Resource:** `MediaLinkResource`
- Add to the `/admin` navigation so you can easily Add/Edit/Delete Media Links, upload their logos, and adjust the display order.

### 3. Frontend Controller & Route
- **Route:** Update `routes/web.php` to map `/media` to a new `MediaController@index`.
- **Controller:** Fetch all active `MediaLink` records ordered by `sort_order`, then pass them to the frontend using Inertia.js.

### 4. Frontend UI (`resources/js/Pages/Media/Index.vue`)
- Create a beautiful, modern grid page that loops through the dynamic Media Links.
- It will display the logo, the localized name (Khmer/English depending on user's current language), and link directly to the provided URL in a new tab.

### 5. Navbar Update
- Revert the "Media & Broadcasting" item in `Navbar.vue` from a dropdown to a single direct link pointing to `/media`.

> [!IMPORTANT]
> **User Review Required:** Does this database structure (English/Khmer names, URL, Logo upload, and Status toggle) meet your needs for managing the Media & Broadcasting links? Click "Proceed" if you approve!
