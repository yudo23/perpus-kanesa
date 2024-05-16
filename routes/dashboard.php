<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;

Route::group(["as" => "auth.", "prefix" => "auth", "namespace" => "Auth"], function () {

    Route::group(["as" => "login.", "prefix" => "login"], function () {
        Route::get('/', 'LoginController@index')->name('index');
        Route::post('/', 'LoginController@post')->name('post');
    });

    Route::get('/logout', 'LogoutController@logout')->name("logout");
});

Route::group(['middleware' => ['auth']], function () {
    Route::impersonate();

	Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);

	Route::get('/', 'DashboardController@index')->name('index')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN, RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);

    Route::get('notification', 'NotificationController@notification')->name('notification')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);
	Route::get('notification/read/{id}', 'NotificationController@notificationRead')->name('notification.read')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);
	Route::get('notification/markAsRead', 'NotificationController@markAsRead')->name('notification.markAsRead')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);

    Route::group(["as" => "profile.", "prefix" => "profile"], function () {
		Route::get('/', 'ProfileController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);
		Route::put('/updatePassword', 'ProfileController@updatePassword')->name("updatePassword")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);
        Route::put('/updateAvatar', 'ProfileController@updateAvatar')->name("updateAvatar")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR,RoleEnum::STUDENT])]);
	});

    Route::group(["as" => "users.", "prefix" => "users"], function () {
		Route::get('/', 'UserController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::get('/create', 'UserController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::get('/{id}', 'UserController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::get('/{id}/edit', 'UserController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::post('/', 'UserController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::put('/{id}', 'UserController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::delete('/{id}', 'UserController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::get('/{id}/impersonate', 'UserController@impersonate')->name("impersonate")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
	});

	Route::group(["as" => "students.", "prefix" => "students"], function () {
		Route::post('/importExcel', 'StudentController@importExcel')->name("importExcel")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);

		Route::get('/', 'StudentController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'StudentController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'StudentController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'StudentController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'StudentController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'StudentController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'StudentController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/impersonate', 'StudentController@impersonate')->name("impersonate")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "settings.", "prefix" => "settings","namespace" => "Setting"], function () {
		Route::group(["as" => "dashboard.", "prefix" => "dashboard"], function () {
			Route::get('/', 'DashboardSettingController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
			Route::put('/', 'DashboardSettingController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		});
	});

	Route::group(["as" => "biblios.", "prefix" => "biblios"], function () {
		Route::get('/exportPDF', 'BiblioController@exportPDF')->name("exportPDF")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}/updateSynopsis', 'BiblioController@updateSynopsis')->name("updateSynopsis")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/qrcode', 'BiblioController@qrcode')->name("qrcode")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);

		Route::get('/', 'BiblioController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'BiblioController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "contacts.", "prefix" => "contacts"], function () {
		Route::get('/', 'ContactController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'ContactController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});
});