<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(["as" => "landing-page.", "namespace" => "LandingPage"], function () {
    Route::get('/', 'HomeController@index')->name("home.index");

    Route::group(["as" => "contacts.", "prefix" => "contacts"], function () {
        Route::get('/', 'ContactController@index')->name('index');
        Route::post('/', 'ContactController@store')->name('store');
    });
});
