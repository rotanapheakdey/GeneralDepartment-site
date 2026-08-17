---
name: feature-scaffold
description: Scaffolds complete full-stack features including schema migrations, backend service endpoints, Filament resources, and frontend Vue/Inertia components.
---

# Feature Scaffolding Recipe (Laravel 11 + Filament + Vue/Inertia)

## Workflow
1. **Schema Check:** Query the connected MySQL database MCP server to verify existing relational structures and foreign keys.
2. **Backend Scaffold:**
   - Run `php artisan make:model <Name> -m` to create migration and model.
   - Implement `$fillable` or `$guarded` properties and casts in the Model.
   - If this is an admin feature, run `php artisan make:filament-resource <Name>` to scaffold the CRUD interface for the Filament Admin Panel.
   - If this is a public frontend feature, create a standard Controller (`php artisan make:controller`) and use `Inertia::render('Path/To/Page')`.
3. **Frontend Scaffold (Public Pages):**
   - Create `.vue` components in `resources/js/Pages/` and `resources/js/Components/`.
   - Use `<script setup>` and define props using `defineProps`.
   - Ensure the layout is wrapped in the appropriate Layout component (e.g., `GuestLayout` or `GovLayout`).
4. **Verification:**
   - Ensure `npm run build` is executed to compile Vue components.
   - Run the local dev server (`php artisan serve` or Sail) and trigger the Browser Subagent to confirm zero console errors.
