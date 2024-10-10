<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('dashboard/expedientes', 'record.records')
    ->middleware('auth')
    ->name('dashboard.expedientes');

Route::view('dashboard/agendar-cita', 'record.appointment')
    ->middleware('auth')
    ->name('dashboard.cita');

Route::view('dashboard/agendar-cita/editar/{appointmentId}', 'record.edit-appointment')
    ->middleware('auth')
    ->name('dashboard.editarCita');

Route::view('dashboard/agenda', 'record.schedule')
    ->middleware('auth')
    ->name('dashboard.agenda');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/* Route::get('/sitemap', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'));

    return $sitemap->writeToFile(public_path('sitemap.xml'));
}); */

require __DIR__ . '/auth.php';
