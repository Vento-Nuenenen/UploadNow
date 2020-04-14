<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontendController@index')->name('front');
Route::get('/{formID}', 'FrontendController@show');
Route::post('/{formID}/send', 'FrontendController@send');

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function (){
    Route::get('/overwatch', 'OverwatchController@index')->name('overwatch');

    Route::any('/forms', 'FormsController@index')->name('forms');
    Route::get('/forms/show/{formID}', 'FormsController@show')->name('forms-show');
    Route::get('/forms/add', 'FormsController@create')->name('add-forms');
    Route::post('/forms/store', 'FormsController@store')->name('store-forms');
    Route::post('forms/import', 'FormsController@import')->name('import-forms');
    Route::get('/forms/edit/{formID}', 'FormsController@edit')->name('edit-forms');
    Route::post('/forms/update/{fid}', 'FormsController@update')->name('update-forms');
    Route::get('/forms/destroy/{fid}', 'FormsController@destroy')->name('destroy-forms');
});
