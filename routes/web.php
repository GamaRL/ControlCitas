<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Login routes
Route::view('login', 'login')->name('login');

Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Doctors routes
Route::resource('doctors', DoctorController::class)
    ->only('create', 'store');

// Patients routes
Route::resource('patients', PatientController::class)
    ->only('create', 'store');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

// Appointment routes
Route::resource('appointments', AppointmentController::class)->only('index', 'create');

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
