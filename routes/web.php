<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
Route::middleware('auth')->group(function () {
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post(uri: '/logout', action: [UserController::class, 'logout']) ->name(name: 'logout');
    });

    Route::get(uri: '/profile', action: [ProfileController::class, 'profile']) ->name(name: 'profile');
    Route::get(uri: '/profile/edit', action: [ProfileController::class, 'editProfile']) ->name(name: 'editProfile');
    Route::put(uri: '/profile', action: [ProfileController::class, 'updateProfile']) ->name(name: 'updateProfile');
    Route::get(uri: '/profile/{user}', action: [ProfileController::class, 'viewProfile']) ->name(name: 'user.profile');

    Route::get(uri: '/search', action: [SearchController::class, 'search']) ->name(name: 'search');
});

Route::middleware('guest')->group(function () {

    Route::get(uri: '/login', action: [UserController::class, 'login']) ->name(name: 'login');  
    Route::post(uri: '/login', action: [UserController::class, 'authenticate']) ->name(name: 'authenticate');
    Route::get(uri: '/register', action: [UserController::class, 'register']) ->name(name: 'register');
    Route::post(uri: '/register', action: [UserController::class, 'storeUser']) ->name(name: 'storeUser');
    Route::get(uri: '/forget-password', action: [UserController::class, 'forget']) ->name(name: 'forget');
    Route::post(uri: '/forget-password', action: [UserController::class, 'sendResetLink']) ->name(name: 'sendResetLink');
    Route::get(uri: '/reset-password/{token}', action: [UserController::class, 'reset']) ->name(name: 'reset');
    Route::post(uri: '/reset-password', action: [UserController::class, 'updatePassword']) ->name(name: 'updatePassword');
});

Route::get('auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');
Route::get('auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    
    $user = User::where('provider', 'github')
                ->where('provider_id', $githubUser->getId())
                ->first();
    if ($user) {
        $user->update(['provider_id' => $githubUser->getId(),
        'email_verified_at' => now(),]);
    }else {
    $user = User::Create([
            'name' => $githubUser->getName(),
            'provider' => 'github',
            'provider_id' => $githubUser->getId(),
            'picture' => $githubUser->getAvatar(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(24)),
        ]
    );
    }

    // Here you can handle the authenticated user information,
    // such as creating or updating a user in your database.        

    // For example, you might want to log the user in:
    Auth::login($user); 

    return redirect()->route('posts.index');
})->name('auth.github.callback');

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
    })->name('auth.google');
    Route::get('auth/google/callback', function () {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('provider', 'google')
                ->where('provider_id', $googleUser->getId())
                ->first();
        if ($user) {
            $user->update(['provider_id' => $googleUser->getId(),
            'email_verified_at' => now(),]);
        }else { 

        $user = User::Create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'picture' => $googleUser->getAvatar(),
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(24)),
            ]
        );
        }

    // Here you can handle the authenticated user information,
    // such as creating or updating a user in your database.        

    // For example, you might want to log the user in:
    Auth::login($user); 

    return redirect()->route('posts.index');
})->name('auth.google.callback');   

