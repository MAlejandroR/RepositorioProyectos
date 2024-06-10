<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use mysql_xdevapi\Session;

class MainController extends Controller
{
    //
    public function __invoke(){
//        session()->flush();
        info ("En Maincontroller@__invoke ");
        info (session()->all());
        $list_of_lang = config("language");
        $departaments = config("departaments");
//        info ($departaments);



        return Inertia::render('Welcome', [
//            'canLogin' => Route::has('login'),
//            'canRegister' => Route::has('register'),
//            'laravelVersion' => Application::VERSION,
//            'phpVersion' => PHP_VERSION,
            'list_of_lang'=>$list_of_lang,
            'departaments'=>$departaments
        ]);
    }
    public function show_projects(){
        return Inertia::render("Projects/Listado");


    }
}
