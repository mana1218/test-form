<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm',[ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/contacts/edit', [ContactController::class, 'index']);
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete/{id}', [AdminController::class, 'destroy']);
});