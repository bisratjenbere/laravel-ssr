<?php

use App\enum\PermissionsEnum;
use App\enum\RolesEnum;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpvoteController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['verified'])->group(function () {
        Route::get("/user" ,[UserController::class, 'index'])->name('user.index');
        Route::get("/user/{user}/edit" ,[UserController::class, 'edit'])->name('user.edit');
        Route::put("/user/{user}" ,[UserController::class, 'update'])->name('user.update');
    });
    Route::middleware(['verified', sprintf('role:%s|%s|%s', RolesEnum::User->value, RolesEnum::Admin->value, RolesEnum::Commenter->value)])->group(function () {
         Route::resource('/feature', FeatureController::class)->except(['index', 'show']);
        Route::get('/feature', [FeatureController::class, 'index'])->name('feature.index');
        Route::get('/feature/{feature}', [FeatureController::class, 'show'])->name('feature.show');
        Route::get('/feature/{feature}/edit', [FeatureController::class, 'edit'])->name('feature.edit');
        Route::put('/feature/{feature}', [FeatureController::class, 'update'])->name('feature.update');
        Route::delete('/feature/{feature}', [FeatureController::class, 'destroy'])->name('feature.destroy');
    });

});

require __DIR__.'/auth.php';
