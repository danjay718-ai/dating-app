<?php

use App\Http\Controllers\BrowseProfileController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DatingProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
| All routes below require the user to be logged in.
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard no longer exists — redirect to Browse
    Route::get('/dashboard', fn () => redirect()->route('browse.index'))->name('dashboard');

    // Breeze account settings (name, email, password, delete account)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dating profile (bio, age, gender, location)
    Route::get('/dating-profile', [DatingProfileController::class, 'edit'])->name('dating-profile.edit');
    Route::put('/dating-profile', [DatingProfileController::class, 'update'])->name('dating-profile.update');

    // Browse other users
    Route::get('/browse', [BrowseProfileController::class, 'index'])->name('browse.index');
    Route::get('/browse/{user}', [BrowseProfileController::class, 'show'])->name('browse.show');

    // Conversations
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::post('/conversations/{user}', [ConversationController::class, 'store'])->name('conversations.store');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');

    // Messages (nested under a conversation)
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');
});

require __DIR__.'/auth.php';

