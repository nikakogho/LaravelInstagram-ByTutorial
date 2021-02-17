<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/email/welcome', function () {
    return new App\Mail\WelcomeRegisteredUserMail();
});

Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::get('/', function () {
    return redirect('/p');
});
Route::get('/p', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/p/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/p', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/p/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::get('/profile', function () {
    $user = auth()->user();

    return redirect($user ? ('/profile/' . $user->id) : '/login');
});
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
