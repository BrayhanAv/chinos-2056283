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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('media-types/insert','MediaTypeController@showmas');
Route::post('media-types/store','MediaTypeController@storemas');

Route::get('masterpage',function(){
    return view('layouts.masterpage');
});
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rutas prefijadas
Route::prefix('Imagenes')->group(function(){

    Route::get('crear', 'ImageController@create');
    Route::post('guardar', 'ImageController@store');

});

//ruta de get

Route::get('PDF', "PDFController@index");

