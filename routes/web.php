<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facade as Debugbar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@show')->name('index.show');

Route::post('/domains', 'DomainsController@store')->name('domains.store');

Route::get('/domains', 'DomainsController@index')->name('domains.index');

Route::get('/domains/{id}', 'DomainsController@show')->name('domains.show');

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});
