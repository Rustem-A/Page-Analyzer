<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        # Если пользователь уже был на нашем сайте, то в сессии будет значение выбранного им языка.
        $raw_locale = Session::get('locale');
        # Проверяем, что у пользователя в сессии установлен доступный язык (а не какая-нибудь бяка)
        if (in_array($raw_locale, Config::get('app.locales'))) {
        # И присваиваем значение переменной $locale.
            $locale = $raw_locale;
        } else {
        #В ином случае присваиваем ей язык по умолчанию.
            $locale = Config::get('app.locale');
        }
        # Устанавливаем локаль приложения
        App::setLocale($locale);
        # И позволяем приложению работать дальше
        return $next($request);
    }
}
