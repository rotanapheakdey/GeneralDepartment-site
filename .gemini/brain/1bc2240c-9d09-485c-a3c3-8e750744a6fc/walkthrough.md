# Walkthrough: Dynamic Media Links

## What was changed

The "Media & Broadcasting" section has been successfully transformed from a static dropdown menu into a fully dynamic directory that you can manage through the backend.

### 1. Database & Filament Integration
- Added a `media_links` database table tracking English Names, Khmer Names, URLs, Active status, and Sort Order.
- Created `MediaLinkResource` in Filament.
- **You can now manage these links directly at `/admin/media-links`**. 
- The form allows you to attach an official logo image (via Spatie Media Library), set the translation names, control the sorting order, and toggle the `is_active` switch to instantly hide/show links.

### 2. Frontend Restructuring
- The `/media` route now points to a dedicated `MediaController`.
- Built a modern, responsive grid page at `resources/js/Pages/Media/Index.vue`.
- The grid dynamically renders cards based on the active records from the database. It handles fallbacks beautifully if a logo isn't uploaded.
- Updated `Navbar.vue` to strip out the old dropdown logic and insert a clean, direct link to the new `/media` page.

### Next Steps
The page will currently show as an "Empty State" until you log into the admin panel (`/admin`) and create some Media Links (e.g., "TVK Live", "National Radio", "AKP Agency").
