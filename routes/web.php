<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return redirect()->route('users.index');
//    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//    Route::get('delete-user-list', [UserController::class, 'deletedList'])->name('users.soft-delete');
//    Route::get('restore-user/{id}', [UserController::class, 'restore'])->name('users.restore');
//    Route::delete('permanent-delete-user/{id}', [UserController::class, 'forceDelete'])->name('users.force-delete');
    Route::softDeletes('users', 'UserController', ['auth']);
    Route::resource('users', UserController::class);

});

require __DIR__.'/auth.php';
