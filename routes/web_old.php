<?php



use App\Http\Controllers\ModelController\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Lang\LanguageControllerFilament;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HandlerProviderCallback;
use App\Http\Controllers\User\StudentController;
use App\Http\Controllers\User\TeacherController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Rutas de google

 Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});
 Route::get("/auth/{provider}/callback", HandlerProviderCallback::class)->name("socialite.callback");
 Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});



//Fortify::loginView([CustomAuthenticatedSessionController::class, 'create']);
//Route::middleware(['guest','inertia'])->group(function () {
//    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//});


//The main route is like login route
//Route::get('/', MainController::class)->middleware("inertia")->name("dashboard");
//Route::get('/', MainController::class)->middleware("guest","inertia");
//Route::get('/', function () {
//    if (auth()->check() && ! auth()->user()->hasVerifiedEmail()) {
//        return redirect()->route('verification.notice');
//    }
//
//    return app(MainController::class);
//})->middleware('inertia');

Route::get('/listado', [MainController::class, "show_projects"])
    ->name('listado')->middleware(["auth", "verified"]);
/*
Route::get('/dashboard', function () {
    return Inertia::render('Projects/Listado');
})->name('dashboard')->middleware('auth', 'verified');
*/

//Establecer un lenguaje
Route::get("set_lang", \App\Http\Controllers\LanguageController::class);


//Todo teacher como admin no tendría que tener inertia, ya que accede a _filament ??????

Route::middleware(['auth', 'verified','inertia'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get("query_projects",[ProjectController::class,"teacher_query"])->name("teacher.query_projects");
});
//Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware("auth","inertia");


Route::get('/admin/change-locale/{locale}',LanguageControllerFilament::class)
->name('change-locale');


//AÑado esto que dice el chat, pero no termino de verlo

Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail'); // tu componente Vue
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


Route::resource('cycles', \App\Http\Controllers\ModelController\CycleController::class)->except('create', 'edit');

Route::resource('students', \App\Http\Controllers\ModelController\StudentController::class)->except('create', 'store', 'edit');

Route::resource('teachers', \App\Http\Controllers\ModelController\TeacherController::class)->except('create', 'store', 'edit');

Route::resource('enrollments', \App\Http\Controllers\ModelController\EnrollmentController::class)->except('create', 'edit', 'update');

Route::resource('projects', \App\Http\Controllers\ModelController\ProjectController::class)->except('create', 'edit');


Route::get("verify-code",fn()=> Inertia::render("VerifyCode"))->name('verify-code')->middleware("auth");
Route::post("verify-code",[\App\Services\OtpService::class,"verifyCode"])->name('verify-code-post')->middleware(["auth","inertia"]);

// routes/web.php
Route::get('/api/project-search', [\App\Http\Controllers\ProjectSearchController::class, 'search'])->name('project.search');



//Route::post('/login', [CustomAuthenticatedSessionController::class, 'store']);

//Logout necesito para controlar el logout y redirecciones ????


Route::get("/", function(){
    if (Auth::check()) {
        $role =Auth::user()->getRoleNames()->first();
        return match ($role) {
            'admin' => redirect("/admin"),
            'teacher' => redirect()->route('teacher.dashboard'),
            'student' => redirect()->route('students.dashboard'),
            default => app(MainController::class)->__invoke(request())
        };
    }
    return app(MainController::class)->__invoke(request());
})
    ->middleware("inertia")
    ->name("dashboard");;



Route::post('/logout', [\App\Http\Controllers\Auth\CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');
