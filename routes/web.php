<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/lyrium', 'lyrium')->name('lyrium');
    Route::get('/ece/{nivel}', 'ece')->name('ece');
    Route::get('/mvs', 'mvs')->name('mvs');
    Route::get('/productos', 'productos')->name('productos');
    Route::get('/productos/{producto}', 'producto')->name('producto');
    Route::get('/contacto', 'contacto')->name('contacto');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
