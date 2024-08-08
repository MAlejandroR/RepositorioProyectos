<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = $request->input("locale");
//        info("1.-LanguageController.  locale -$locale-");
        session()->put("locale", $locale);
//        info("2.-LanguageController. Valor de app()->getLocale -".app()->getLocale()."-");
//       return redirect()->back();

        //Esto me enviaría a la página de la que vengo
        //Pero provoca una nueva carga completa de la página, y no quiero
//        return Inertia::location(request()->header('Referer'));
        $translation = file_get_contents(base_path("lang/$locale.json"));
        $datos = json_decode($translation,true);
        $title=$datos['Project Repository'];
//        info("3.-LanguageController.  title -$title-");
//        info("4.-LanguageController.  translation -$translation-");
        return response()->json(["translation"=>$translation, "title"=>$title]);



//        return response()->json("OK! se ha establecido $locale");

        //
    }
}
