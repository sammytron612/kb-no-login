<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


use App\Livewire\Sections;
use App\Http\Controllers\AdminController;
use App\Livewire\ArticleSearch;
use App\Http\Controllers\DraftsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::middleware(['auth'])->group(function () {
    Route::get('search', ArticleSearch::class)->name('search');
    Route::get('/sections', Sections::class)->name('sections');
    Route::get('/admin', [AdminController::class,'index'])->name('admin');
    Route::post('/upload-image', [\App\Http\Controllers\ImageUploadController::class, 'store'])->name('image.upload');
    Route::get('articles/create', [\App\Http\Controllers\CreateArticleController::class, 'show'])->name('articles.create');
    Route::post('articles/create', [\App\Http\Controllers\CreateArticleController::class, 'store'])->name('articles.store');
    Route::get('articles/{id}/edit', [\App\Http\Controllers\EditArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/{id}', [\App\Http\Controllers\EditArticleController::class, 'update'])->name('articles.update');
    Route::get('/articles/{id}', [\App\Http\Controllers\ArticlessController::class, 'show'])->name('articles.show');
    Route::get('/drafts', [DraftsController::class, 'index'])->name('drafts');
    Route::get('/stats', [\App\Http\Controllers\StatsController::class, 'index'])->name('stats');
    Route::get('/admin/invites', [\App\Http\Controllers\AdminController::class, 'invites'])->name('admin.invites');
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/approvals', [\App\Http\Controllers\AdminController::class, 'approvals'])->name('admin.approvals');
    Route::get('/admin/notifications', [\App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/approvals/{id}', [\App\Http\Controllers\ApprovalsController::class, 'index'])->name('approvals.show');
    Route::post('/admin/approvals/{id}/approve', [\App\Http\Controllers\ApprovalsController::class, 'approve'])->name('approvals.approve');
    Route::post('/admin/approvals/{id}/reject', [\App\Http\Controllers\ApprovalsController::class, 'reject'])->name('approvals.reject');
    Route::delete('articles/{id}', [\App\Http\Controllers\ArticlesController::class, 'destroy'])->name('articles.destroy');

});
//Route::get('articles/{id}/edit', [\App\Http\Controllers\EditArticleController::class, 'edit'])->name('articles.edit')->middleware(['can:isAdmin'] || 'can:CanEditOrDelete');

Route::get('/api/articles/most-viewed', [\App\Http\Controllers\Api\ArticleStatsController::class, 'mostViewed']);


require __DIR__.'/auth.php';
