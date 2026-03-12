<?php
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PostController;



Route::get('/', function () {
    return Inertia::render('Department/Welcome', [
        'canLogin' => Route::has('login'),
    ]);
});
// news
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{post}', [NewsController::class, 'show'])->name('news.show');Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');


// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
