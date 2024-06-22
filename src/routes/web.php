<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'admin']);
});

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::get('/contacts/fix', [ContactController::class, 'fix'])->name('contacts.fix');
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts/{id}', [ContactController::class, 'show']);
