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
use App\Http\Controllers\ChatbotController;
use Illuminate\Http\Request;


include __DIR__."/verify.php";


Route::get('/chatbot', function () {
    return Inertia::render('Dashboard/Teacher/Chatbot');
})->middleware(["auth", "inertia"]);



Route::post('/chatbot/query', [ChatbotController::class, 'handle']);

Route::get("/", function(){
    if (Auth::check()) {
        $role =Auth::user()->getRoleNames()->first();
        return match ($role) {
            'admin' => redirect("/admin"),
            'teacher' => redirect()->route('teacher.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => app(MainController::class)->__invoke(request())
        };
    }
    return app(MainController::class)->__invoke(request());
})
    ->middleware("inertia")
    ->name("dashboard");



//Todo teacher como admin no tendría que tener inertia, ya que accede a _filament ??????

Route::middleware(['auth', 'verified','inertia'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get("query_projects",[ProjectController::class,"teacher_query"])->name("teacher.query_projects");
});


//Rutas de google

 Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});
 Route::get("/auth/{provider}/callback", HandlerProviderCallback::class)->name("socialite.callback");
 Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});


//Establecer un lenguaje
Route::get("set_lang", \App\Http\Controllers\LanguageController::class);


//Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware("auth","inertia");


Route::get('/admin/change-locale/{locale}',LanguageControllerFilament::class)
->name('change-locale');


Route::resource('cycles', \App\Http\Controllers\ModelController\CycleController::class)->except('create', 'edit');

Route::resource('students', \App\Http\Controllers\ModelController\StudentController::class)->except('create', 'store', 'edit');

Route::resource('teachers', \App\Http\Controllers\ModelController\TeacherController::class)->except('create', 'store', 'edit');

Route::resource('enrollments', \App\Http\Controllers\ModelController\EnrollmentController::class)->except('create', 'edit', 'update');

Route::resource('projects', \App\Http\Controllers\ModelController\ProjectController::class)->except('create', 'edit');



// routes/web.php
Route::get('/api/project-search', [\App\Http\Controllers\ProjectSearchController::class, 'search'])->name('project.search');



//Route::post('/login', [CustomAuthenticatedSessionController::class, 'store']);

//Logout necesito para controlar el logout y redirecciones ????



Route::post('/logout', [\App\Http\Controllers\Auth\CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::post('/set-password', function (Request $request) {
    $request->validate([
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = $request->user();
    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('message', 'Contraseña actualizada');
})->middleware(['auth']);
