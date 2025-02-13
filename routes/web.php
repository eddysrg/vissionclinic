<?php

use App\Models;
use App\Models\Clinic;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

Volt::route('/', 'pages.home.home')->name('home');
Volt::route('/ece/nivel-uno', 'pages.home.ece-first')->name('ece-first');
Volt::route('/ece/nivel-dos', 'pages.home.ece-second')->name('ece-second');
Volt::route('/mvs', 'pages.home.mvs')->name('mvs');
Volt::route('/lyrium', 'pages.home.lyrium')->name('lyrium');
Volt::route('/productos', 'pages.home.products')->name('products');
Volt::route('/productos/laboratorio', 'pages.home.products.laboratorio')->name('laboratorio');
Volt::route('/productos/ingresos', 'pages.home.products.ingresos')->name('ingresos');
Volt::route('/productos/medical-view-system', 'pages.home.products.mvs')->name('medicalViewSystem');
Volt::route('/productos/odontologia', 'pages.home.products.odontologia')->name('odontologia');
Volt::route('/productos/nutricion', 'pages.home.products.nutricion')->name('nutricion');
Volt::route('/productos/ginecologia', 'pages.home.products.ginecologia')->name('ginecologia');
Volt::route('/contacto', 'pages.home.contact')->name('contacto');


Route::controller(PageController::class)->group(function () {
    // Route::get('/productos', 'productos')->name('productos');
    // Route::get('/productos/{producto}', 'producto')->name('producto');
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('dashboard/expedientes', 'record.records')
    ->middleware('auth')
    ->name('dashboard.expedientes');

Route::prefix('dashboard/expedientes/{id}')
    ->name('dashboard.expedientes.')
    ->middleware('auth')
    ->group(function () {

        Route::get('resumen', [RecordController::class, 'summary'])
        ->name('summary');

        Route::prefix('medical-record')
        ->name('medical-record.')
        ->group(function () {
            Route::get('identification-form', [RecordController::class, 'identificationForm'])
                ->name('identification-form');

            Route::get('family-medical-history', [RecordController::class, 'familyMedicalHistory'])
                ->name('family-medical-history');

            Route::get('pathological-history', [RecordController::class, 'pathologicalHistory'])
                ->name('pathological-history');

            Route::get('no-pathological-history', [RecordController::class, 'noPathologicalHistory'])
                ->name('no-pathological-history');

            Route::get('physical_examination', [RecordController::class, 'physicalExamination'])
                ->name('physical-examination');
        });

        Route::get('medical-consultation', [RecordController::class, 'medicalConsultation'])
        ->name('medicalConsultation');

        Route::get('laboratory', [RecordController::class, 'laboratory'])
        ->name('laboratory');

        Route::get('reference', [RecordController::class, 'reference'])
        ->name('reference');

        Route::get('prescription-register', [RecordController::class, 'prescriptionRegister'])
        ->name('prescriptionRegister');

        Route::get('digital-file', [RecordController::class, 'digitalFile'])
        ->name('digitalFile');

        Route::get('medical-record', [RecordController::class, 'medicalRecord'])
        ->name('medicalRecord');
    });

/* Route::get('dashboard/expedientes/{id}/medical-record', [RecordController::class, 'medicalRecord'])
    ->middleware('auth')
    ->name('dashboard.expedientes.medicalRecord'); */

Route::view('dashboard/agenda', 'record.schedule')
    ->middleware('auth')
    ->name('dashboard.agenda');

Route::get('manage-users', [UserController::class, 'manageUsers'])
    ->middleware('auth')
    ->name('manageUsers');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/update-photo', [ProfileController::class, 'updatePhoto'])
    ->middleware(['auth'])
    ->name('photo.update');

require __DIR__ . '/auth.php';
