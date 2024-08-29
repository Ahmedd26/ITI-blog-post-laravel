<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/posts');
});

// Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
// Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
// Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
// Route::get('/posts/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
// Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
// Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
// Route::get('/posts/{id}/destroy', [PostsController::class, 'destroy'])->name('posts.destroy')->where('id', '[0-9]+');

use App\Http\Controllers\PostController;
Route::resource('posts', PostController::class);

use App\Http\Controllers\CreatorController;
Route::resource('creators', CreatorController::class);