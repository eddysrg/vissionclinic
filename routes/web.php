<?php

use App\Http\Controllers\DashboardController;
use App\Models;
use App\Models\Clinic;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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

Route::view('/', 'pages.home')->name('home');

Route::controller(PageController::class)->group(function () {
    Route::get('/lyrium', 'lyrium')->name('lyrium');
    Route::get('/ece/{nivel}', 'ece')->name('ece');
    Route::get('/mvs', 'mvs')->name('mvs');
    Route::get('/productos', 'productos')->name('productos');
    Route::get('/productos/{producto}', 'producto')->name('producto');
    Route::get('/contacto', 'contacto')->name('contacto');
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('dashboard/expedientes', 'record.records')
    ->middleware('auth')
    ->name('dashboard.expedientes');

Route::view('dashboard/agenda', 'record.schedule')
    ->middleware('auth')
    ->name('dashboard.agenda');

Route::get('manage-users', [UserController::class, 'manageUsers'])
    ->middleware('auth')
    ->name('manageUsers');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
