<?php

namespace App\Http\Controllers\Lang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageControllerFilament extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $locale)
    {
        info("LanguageControllerFilament@invoke  modifing locale to: $locale");
        session()->put('locale', $locale);
        //dd ($locale);
        //guardar en cookies, ya que cuando se cierra el panel de filament se destruye
        // todas las sesiones ????? y para poder recuperar luego el idioma seleccionado.

        cookie()->queue(cookie('locale', $locale, 525600, null, null, false, false, false, 'strict'));
        session()->save();
        app()->setLocale($locale);
        info("LanguageControllerFilament@invoke locale is now: " . app()->getLocale());
        return redirect()->back();
//        return redirect('/admin');
    }
}
