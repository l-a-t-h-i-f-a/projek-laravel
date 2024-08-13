<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::get('admin/dashboard', [HomeController::class, 'index']);
 
    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin/posts');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin/posts/create');
    Route::post('/admin/posts/store', [PostController::class, 'store'])->name('admin/posts/store');
    Route::get('/admin/posts/edit/{id}', [PostController::class, 'edit'])->name('admin/posts/edit');
    Route::put('/admin/posts/edit/{id}', [PostController::class, 'update'])->name('admin/posts/update');
    Route::get('/admin/posts/destroy/{id}', [PostController::class, 'destroy'])->name('admin/posts/destroy');
});
require __DIR__.'/auth.php';

//Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);
