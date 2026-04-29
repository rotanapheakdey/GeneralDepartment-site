<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PostController;
use App\Models\Document;

Route::get('/', [HomeController::class, 'index'])->name('home');

// news
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{post}', [NewsController::class, 'show'])->name('news.show');

// documents
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', function () {
    return inertia('About/Index');
})->name('about');

Route::get('/documents/preview/{document}', function (App\Models\Document $document) {
    $path = storage_path('app/public/' . $document->file_path);

    if (!file_exists($path)) {
        abort(404, 'File not found');
    }

    $file = file_get_contents($path);

    return response($file, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="document.pdf"',
        'Cache-Control' => 'no-cache, no-store, must-revalidate',
        'Pragma' => 'no-cache',
        'Expires' => '0',
    ]);
})->name('documents.preview');
require __DIR__.'/auth.php';
