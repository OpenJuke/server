<?php

use App\Http\Controllers\Admin\Content\ArtistController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\IndexController as AuthIndexController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\Admin\UserController;

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

// Auth
Route::get('/', [AuthIndexController::class, 'index'])->middleware('guest')->name('index');

Route::get('/auth/login', [AuthLoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/auth/login', [AuthLoginController::class, 'login'])->middleware('guest')->name('login');

Route::get('/auth/register', [AuthRegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/auth/register', [AuthRegisterController::class, 'store'])->middleware('guest')->name('register');

Route::get('/auth/logout', [AuthIndexController::class, 'logout'])->middleware('auth')->name('logout');

// Discovery
Route::get('/discovery', [DiscoveryController::class, 'index'])->middleware('auth')->name('discovery.index');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);

    Route::prefix('content')->name('content.')->group(function () {
        Route::resource('artists', ArtistController::class);
    });
});
