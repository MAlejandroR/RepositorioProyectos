<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;



class LanguageSwitcher extends Widget
{
    protected string $view = 'filament.widgets.language-switcher';
    public static ?int $sort = -1; //Para que aparezca en el header ????

    protected int | string | array $columnSpan ='full';


    public function setLocale($locale){
        session()->put("locale", $locale);
        App::setLocale($locale);
        return redirect(request()->header('Referer')??route('filament.pages.dashboard'))->back();
    }

    protected function getLanguage(): array
    {
        return config('language',[]);
            //
    }


}
