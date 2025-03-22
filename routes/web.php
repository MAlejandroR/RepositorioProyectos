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




Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});


Route::get("/auth/{provider}/callback",HandlerProviderCallback::class)->name("socialite.callback");

Route::get('/auth/redirect', function () {
   return Socialite::driver('google')->redirect();
});
//Fortify::loginView([CustomAuthenticatedSessionController::class, 'create']);




Route::get('/', MainController::class)->middleware("guest");
Route::get('/listado',[MainController::class, "show_projects"])
    ->name('listado')->middleware(["auth","verified"]);

Route::get('/dashboard', function () {
    return Inertia::render('Projects/Listado');
})->name('dashboard')->middleware('auth','verified');

Route::get("set_lang", \App\Http\Controllers\LanguageController::class);

//Route::post('/login', [CustomAuthenticatedSessionController::class, 'store']);
Route::post('/logout', [\App\Http\Controllers\Auth\CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth','role.redirect'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');

});
