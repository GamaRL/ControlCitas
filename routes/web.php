<?php

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

Route::get('/', function () {
    return view('doctors.register');
})->name('home');

Route::get('/login', function() {
    return view('doctors.login');
})->name('login');

Route::get('/register', function() {
    return view('doctors.register');
})->name('register');

Route::post('/register', [\App\Http\Controllers\DoctorController::class, 'store'])->name('doctor.store');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
