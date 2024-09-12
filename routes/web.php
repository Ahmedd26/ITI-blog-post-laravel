<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/callback', function () {
    // $user = Socialite::driver('github')->user();
    $githubUser = Socialite::driver('github')->user();


    # IF User exists, redirect to Login
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'password' => $githubUser->token,
        'image' => $githubUser->getAvatar(),
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/home');
    // $user->token;
});