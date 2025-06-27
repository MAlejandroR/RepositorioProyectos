<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;



//RUTAS DE VERIFY
//AÑado esto que dice el chat, pero no termino de verlo
Route::get('/email/verify', function () {
    if (Auth::check()){
        if (Auth::user()->getRoleNames()->first()=="admin")
            return redirect("admin");
    }
    $lang = session()->get('locale') ?? "es";
    return Inertia::render('Auth/VerifyEmail',compact("lang")); // tu componente Vue
})->middleware(['auth','inertia'])->name('verification.notice');




Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // Aquí puedes detectar el rol
    $rol = $request->user()->getRoleNames()->first();


    return match ($rol) {
        'admin' => redirect('/admin'),
        'teacher' => redirect('/teacher'),
        'student' => redirect('/student'),
        default => redirect('/'),
    };
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function () {
    auth()->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get("verify-code",fn()=> Inertia::render("Auth/VerifyCode"))->name('verify-code')->middleware("auth","inertia");
Route::post("verify-code",[\App\Services\OtpService::class,"verifyCode"])->name('verify-code-post')->middleware(["auth","inertia"]);
?>
