<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MainController;
use Laravel\Fortify\Fortify;
Fortify::loginView([CustomAuthenticatedSessionController::class, 'create']);



Route::get('/', MainController::class)->middleware("guest");
Route::get('/listado',[MainController::class, "show_projects"])
    ->name('listado')->middleware(["auth","verified"]);
/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
*/
Route::get('/dashboard', function () {
    return Inertia::render('Projects/Listado');
})->name('dashboard')->middleware('auth','verified');
Route::get("set_lang", \App\Http\Controllers\LanguageController::class);
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;

Route::post('/login', [CustomAuthenticatedSessionController::class, 'store']);
Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');
