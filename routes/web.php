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

Auth::routes(['register' => false]);

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/overwatch', 'OverwatchController@index')->name('overwatch');

    Route::any('/forms', 'FormsController@index')->name('forms');
    Route::get('/forms/show/{fid}', 'FormsController@show')->name('forms-show');
    Route::get('/forms/add', 'FormsController@create')->name('add-forms');
    Route::post('/forms/store', 'FormsController@store')->name('store-forms');
    Route::post('forms/import', 'FormsController@import')->name('import-forms');
    Route::get('/forms/edit/{fid}', 'FormsController@edit')->name('edit-forms');
    Route::post('/forms/update/{fid}', 'FormsController@update')->name('update-forms');
    Route::get('/forms/destroy/{fid}', 'FormsController@destroy')->name('destroy-forms');

    Route::get('/entries/download/{eid}', 'FormsController@download')->name('entries-download');
    Route::get('/entries/download/all/{hash}', 'FormsController@downloadAll')->name('entries-download-all');
    Route::get('/entries/destroy/{eid}', 'FormsController@destroyEntry')->name('entries-delete');
});

Route::get('/', 'FrontendController@index')->name('front');
Route::get('/{hash}', 'FrontendController@show');
Route::post('/{hash}/send', 'FrontendController@send');
