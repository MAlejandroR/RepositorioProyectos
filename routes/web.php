<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;




Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});


Route::get("/auth/{provider}/callback", function ($provider) {
    $socialUser=Socialite::driver($provider)->user();

    // Look for a user in your database with the same email
    $user = User::where('email', $socialUser->getEmail())->first();
    $rol = $user->getRoleNames()->first();
    info("fortifyServiceProvider->redirectTo($rol)");
    switch ($rol) {
        case 'admin':
            return '/admin';
        case'teacher':
            return '/teacher';
        case 'student':
            return '/student';
    }
    return ("/");

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
Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth','role.redirect'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');

});
