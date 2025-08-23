<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;



use App\Http\Controllers\AdminController;
use App\Livewire\ArticleSearch;
use App\Http\Controllers\DraftsController;
use App\Http\Controllers\EmailController;





Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');;

    Route::get('/admin/invites', [\App\Http\Controllers\InviteController::class, 'index'])->name('admin.invites')->middleware('can:isAdmin');
    Route::post('/admin/invites/send', [\App\Http\Controllers\InviteController::class, 'send'])->name('admin.invites.send')->middleware('can:isAdmin');
    Route::get('search', ArticleSearch::class)->name('search');
    Route::get('/admin', [AdminController::class,'index'])->name('admin');
    Route::post('/upload-image', [\App\Http\Controllers\ImageUploadController::class, 'store'])->name('image.upload')->middleware('can:isAdmin');
    Route::get('articles/create', [\App\Http\Controllers\CreateArticleController::class, 'show'])->name('articles.create')->middleware('can:canCreate');
    Route::post('articles/create', [\App\Http\Controllers\CreateArticleController::class, 'store'])->name('articles.store')->middleware('can:canCreate');
    Route::get('articles/{id}/edit', [\App\Http\Controllers\EditArticleController::class, 'edit'])->name('articles.edit')->middleware('can:canEdit');
    Route::put('articles/{id}', [\App\Http\Controllers\EditArticleController::class, 'update'])->name('articles.update')->middleware('can:canEdit');
    Route::get('/articles/{id}', [\App\Http\Controllers\ArticlesController::class, 'show'])->name('articles.show');
    Route::get('articles/{article}/download-attachments', [\App\Http\Controllers\ArticlesController::class, 'downloadAttachments'])->name('articles.download-attachments');
    Route::get('/drafts', [DraftsController::class, 'index'])->name('drafts');
    Route::get('/stats', [\App\Http\Controllers\StatsController::class, 'index'])->name('stats');
    Route::get('/admin/invites', [\App\Http\Controllers\AdminController::class, 'invites'])->name('admin.invites')->middleware('can:isAdmin');
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users')->middleware('can:isAdmin');
    Route::get('/admin/approvals', [\App\Http\Controllers\AdminController::class, 'approvals'])->name('admin.approvals')->middleware('can:isAdmin');
    Route::get('/admin/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('admin.settings')->middleware('can:isAdmin');
    Route::get('/admin/approvals/{id}', [\App\Http\Controllers\ApprovalsController::class, 'index'])->name('approvals.show')->middleware('can:isAdmin');
    Route::post('/admin/approvals/{id}/approve', [\App\Http\Controllers\ApprovalsController::class, 'approve'])->name('approvals.approve')->middleware('can:isAdmin');
    Route::post('/admin/approvals/{id}/reject', [\App\Http\Controllers\ApprovalsController::class, 'reject'])->name('approvals.reject')->middleware('can:isAdmin');
    Route::delete('articles/{id}', [\App\Http\Controllers\ArticlesController::class, 'destroy'])->name('articles.destroy');
    Route::get('/sections', [\App\Http\Controllers\SectionsController::class, 'index'])->name('sections.index')->middleware('can:canCreate');
    Route::post('/sections', [\App\Http\Controllers\SectionsController::class, 'store'])->name('sections.store')->middleware('can:canCreate');
});
//Route::get('articles/{id}/edit', [\App\Http\Controllers\EditArticleController::class, 'edit'])->name('articles.edit')->middleware(['can:isAdmin'] || 'can:CanEditOrDelete');

Route::get('/api/articles/most-viewed', [\App\Http\Controllers\Api\ArticleStatsController::class, 'mostViewed']);


require __DIR__.'/auth.php';
