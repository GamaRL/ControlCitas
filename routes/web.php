<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorSchedulesController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
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
Route::view('/login', 'login')
    ->name('login')
->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate')
->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')
->middleware('auth');

// Password reset routes
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])
    ->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])
    ->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->middleware('guest')->name('password.update');

// Email verification routes
Route::get('email/verify', [AuthController::class, 'verifyForm'])->name('verification.notice');
Route::get('/email/verification-notification', [AuthController::class, 'resendVerificationLink'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Profile routes
Route::get('profile', [UserController::class, 'index'])
    ->name('profile.view')
    ->middleware(['auth']);

Route::get('profile/edit', [UserController::class, 'edit'])
    ->name('profile.edit')
    ->middleware(['auth']);

Route::put('profile/update', [UserController::class, 'update'])
->name('profile.update')
->middleware(['auth']);

// Doctors routes
Route::resource('doctors', DoctorController::class)
    ->only('create', 'store');

// Patients routes
Route::resource('patients', PatientController::class)
    ->only('create', 'store', 'edit');

// Doctors-Schedule routes
Route::get('doctors/schedules/all', [DoctorSchedulesController::class, 'all'])
    ->name('doctors.schedules.all')->middleware('verified');

Route::resource('doctors.schedules', DoctorSchedulesController::class);

Route::get('appointments/export', [AppointmentController::class, 'export'])
    ->name('appointments.export')
    ->middleware(['auth', 'verified']);

Route::resource('appointments', AppointmentController::class)
    ->only('index', 'create', 'store', 'show')
    ->middleware(['auth','verified']);

Route::get('appointments/sendConfirmReminder/{id}', [AppointmentController::class, 'sendConfirmReminder'])
    ->name('appointments.sendConfirmReminder')
    ->middleware(['auth','verified']);

Route::get('appointments/confirm/{appointment}', [AppointmentController::class, 'confirmAppointment'])
    ->name('appointments.confirm')
    ->middleware(['auth','verified']);

Route::post('appointments/attend/{appointment}', [AppointmentController::class, 'attendAppointment'])
    ->name('appointments.attend')
    ->middleware(['auth','verified']);

Route::get('appointments/cancel/{id}', [AppointmentController::class, 'destroy'])
    ->name('appointments.destroy')
    ->middleware(['auth','verified']);


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(route('home'));
})->middleware(['auth', 'signed'])->name('verification.verify');
