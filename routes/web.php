<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'ImportCsvController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/importfile', function () {
    return view('/admin.import.importfile');
});

Route::get('/importfile', 'ImportCsvController@index');

Route::post('/importfile', 'ImportCsvController@import')->name('import');