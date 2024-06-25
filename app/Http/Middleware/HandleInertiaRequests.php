<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

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
        return array_merge(parent::share($request), [
            'translate' => function () {
                $lang = session()->get("locale") ?? app()->getLocale();
                session()->put("locale", $lang);
                info("lang es -$lang- ");
                $dir = "lang/$lang.json";
                info("dir $dir ");
                $text = file_get_contents(base_path($dir));

//                info("El fichero json es ".$text);
                $text = json_decode($text, true);
//                info("json decode es ".json_encode($text));
                return ($text);

            },
            'user' => fn() => $request->user() ?? null,
            'rol'=>fn () => $request->user()? $request->user()->getRoleNames()->first() : null,
            'csrf_token' => csrf_token(),
            'list_of_lang' => config("language"),
            'departaments' => config("departaments"),
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
}
