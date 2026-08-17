# Repository Guidelines & Architecture Standards

## General Principles & Stack
- **Backend**: Laravel 11. Use \php artisan\ for scaffolding. Models go in \pp/Models/\, Controllers in \pp/Http/Controllers/\.
- **Admin Panel**: Filament PHP v3. Resources go in \pp/Filament/Resources/\.
- **Frontend**: Vue 3 + Inertia.js. Pages go in \esources/js/Pages/\ and Components in \esources/js/Components/\. Always use \<script setup>\ for Vue components.
- **Database**: MySQL. Always verify schema before writing migrations.

## Automated Verification Workflow
1. Before proposing code changes, inspect existing patterns in the directory.
2. After writing code, run the relevant test suite or invoke the browser subagent to verify functionality. Ensure to handle SPA routing properly during subagent navigation.
3. If changes involve frontend assets, ensure pm run build\ is executed if Vite HMR is not active.
