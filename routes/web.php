<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorSchedulesController;
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

// Doctors-Schedule routes
Route::get('doctors/schedules/all', [DoctorSchedulesController::class, 'all'])
    ->name('doctors.schedules.all');
Route::resource('doctors.schedules', DoctorSchedulesController::class);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(route('home'));
})->middleware(['auth', 'signed'])->name('verification.verify');
