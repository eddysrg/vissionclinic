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

// Website routes
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

// Dashboard routes
Volt::route('dashboard', 'pages.record.dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Volt::route('dashboard/expedientes', 'pages.record.records')->middleware('auth')->name('dashboard.expedientes');
Volt::route('dashboard/agenda', 'pages.record.agenda')->middleware('auth')->name('dashboard.agenda');

// Dashboard [record] routes
Route::prefix('dashboard/expedientes/{id}')
    ->name('dashboard.record.')
    ->middleware('auth')
    ->group(function () {

        Volt::route('resumen', 'pages.record.medical-record.summary')->name('summary');
        Volt::route('consulta-medica', 'pages.record.medical-record.medical-consultation')->name('medical-consultation');
        Volt::route('laboratorio', 'pages.record.medical-record.laboratory')->name('laboratory');
        Volt::route('referencia', 'pages.record.medical-record.reference')->name('reference');
        Volt::route('recetario', 'pages.record.medical-record.prescription')->name('prescription');
        Volt::route('archivo-digital', 'pages.record.medical-record.digital-file')->name('digital-file');


        // clinical history routes
        Volt::route('ficha-identificacion', 'pages.record.medical-record.identification-form')->name('identification-form');
        Volt::route('antecedentes-heredofamiliares', 'pages.record.medical-record.hereditary-family-history')->name('hereditary-family-history');
        Volt::route('antecedentes-patologicos', 'pages.record.medical-record.pathological-history')->name('pathological-history');
        Volt::route('antecedentes-no-patologicos', 'pages.record.medical-record.non-pathological-history')->name('non-pathological-history');
        Volt::route('exploracion-fisica', 'pages.record.medical-record.physical-examination')->name('physical-examination');
    });

Route::get('manage-users', [UserController::class, 'manageUsers'])
    ->middleware('auth')
    ->name('manageUsers');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/update-photo', [ProfileController::class, 'updatePhoto'])
    ->middleware(['auth'])
    ->name('photo.update');

// Test route
Route::get('/test', function () {
    return view('layouts.pdf.print-prescription');
});

require __DIR__ . '/auth.php';
