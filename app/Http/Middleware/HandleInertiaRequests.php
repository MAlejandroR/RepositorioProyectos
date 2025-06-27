<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{


    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        //    $this->info();
//        info("HeandleInsertiaRequest@share");
        //     info('--- DEBUG LOCALE ---');
        //     info('session(locale): ' . session()->get('locale'));
        //     info('app()->getLocale(): ' . app()->getLocale());
        //     info('config(app.locale): ' . config('app.locale'));
        $lang = session()->get("locale") ?? app()->getLocale() ?? "es";
        info(__CLASS__."@".__METHOD__.": url ".request()->url());

        //     info("HandleInertiaRequest@share lang es -$lang- ");
        $dir = "lang/$lang.json";
//        info("HeandleInsertiaRequest@share dir -$dir-");

        //     info("HandleInertiaRequest@share dir -$dir-");
        //     info('--- /DEBUG LOCALE ---');
        $translate = function () use ($dir) {
            $text = file_get_contents(base_path($dir));
            $text = json_decode($text, true);
            return ($text);
        };

        $text = file_get_contents(base_path($dir));
        $translate = json_decode($text, true);
        debugMiddlewareInertia("HeandleInsertiaRequest@share fichero traducido -$dir-:");

        $user = $request->user() ?? null;
        $rol =  $request->user() ? $request->user()->getRoleNames()->first() : null;


        info(__CLASS__."@".__METHOD__." rol : -$rol-");
        info(__CLASS__."@".__METHOD__." lang : -$lang-");



        return array_merge(parent::share($request), [
            'translate' => $translate,
            'user' => $user,
            'password_is_null' => fn () => Auth::check() && is_null(Auth::user()->password),
            'rol' => $rol,
            'csrf_token' => csrf_token(),
            'list_of_lang' => config("language"),
            'lang'=> $lang,
            'departaments' => config("departaments"),
            'models' => config("models.models"),
            'flash' => function () use ($request) {
                return [
                    'message' => $request->session()->get('message'),
                    'banner' => $request->session()->get('banner'),
                    'bannerStyle' => $request->session()->get('bannerStyle')
                    // Asegúrate de setear esto donde manejas las excepciones
                ];
            },
        ]);

    }

    /**
     * @return void
     */
    public function info(): void
    {
        //   info("HandleInertiaRequest@share");
        //   info(config('models.'));
    }
}
