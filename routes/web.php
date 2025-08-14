<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Livewire\SearchArticle;
use App\Livewire\Sections;
use App\Livewire\Admin;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::middleware(['auth'])->group(function () {
    Route::get('search', SearchArticle::class)->name('search');
    Route::get('/sections', Sections::class)->name('sections');
    Route::get('/admin', Admin::class)->name('admin');
    Route::post('/upload-image', [\App\Http\Controllers\ImageUploadController::class, 'store'])->name('image.upload');
    Route::get('articles/create', [\App\Http\Controllers\CreateArticleController::class, 'show'])->name('articles.create');
    Route::post('articles/create', [\App\Http\Controllers\CreateArticleController::class, 'store'])->name('articles.store');
    Route::get('articles/{id}/edit', [\App\Http\Controllers\EditArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/{id}', [\App\Http\Controllers\EditArticleController::class, 'update'])->name('articles.update');
});


require __DIR__.'/auth.php';
