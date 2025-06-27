<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index(){
        info ("AdminController@index");
        return Inertia::location("/admin");
//        return Inertia::render('Dashboard/Admin/Index');
    }
}
