<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Models\Document;

Route::get('/', [HomeController::class, 'index'])->name('home');

// News — slug-based routing for SEO
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{post:slug}', [NewsController::class, 'show'])->name('news.show');

// Documents
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

// Auth-protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Static pages
Route::get('/contact', fn () => inertia('Contact/Index'))->name('contact');

use App\Http\Controllers\MediaController;

// Leadership & Organization (Replaces old About Us)
Route::get('/leadership-and-organization', [PageController::class, 'show'])->defaults('slug', 'leadership-and-organization')->name('about_us.index');
Route::get('/leadership-and-organization/structure', [PageController::class, 'show'])->defaults('slug', 'structure')->name('about_us.structure');
Route::get('/leadership-and-organization/units', [PageController::class, 'show'])->defaults('slug', 'units')->name('about_us.units');
Route::get('/leadership-and-organization/leadership', [PageController::class, 'show'])->defaults('slug', 'leadership')->name('about_us.leadership');

// Media & Press
Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::get('/press', fn () => inertia('Contact/Index'))->name('press.index'); // Placeholder
Route::get('/news/category/{category}', [NewsController::class, 'index'])->name('news.category');


// Document PDF preview
Route::get('/documents/preview/{document}', function (Document $document) {
    $path = storage_path('app/public/' . $document->file_path);

    if (!file_exists($path)) {
        abort(404, 'File not found');
    }

    return response(file_get_contents($path), 200, [
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'inline; filename="document.pdf"',
        'Cache-Control'       => 'no-cache, no-store, must-revalidate',
        'Pragma'              => 'no-cache',
        'Expires'             => '0',
    ]);
})->name('documents.preview');

require __DIR__.'/auth.php';
