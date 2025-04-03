<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\HandlerProviderCallback;




// Social Login
Route::get('/auth/google', fn() => Socialite::driver('google')->redirect());
Route::get('/auth/{provider}/callback', HandlerProviderCallback::class)->name('socialite.callback');

// Inicio y dashboard
Route::get('/', MainController::class)->middleware("guest");
Route::get('/dashboard', fn() => Inertia::render('Projects/Listado'))->middleware(['auth', 'verified'])->name('dashboard');

// OTP
Route::middleware(['auth'])->group(function () {
    Route::get('/verify-code', fn() => Inertia::render('Auth/VerifyCode'))->name('verify.code');
    Route::post('/email/send-code', [EmailVerificationController::class, 'sendCode']);
    Route::post('/email/verify-code', [EmailVerificationController::class, 'verifyCode']);
});

// Rutas con rol y OTP verificado
//Route::middleware(['auth', 'verified', 'otp.verified', 'role.redirect'])->group(function () {
Route::middleware(['auth', 'otp.verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
});
