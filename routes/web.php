<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('frontend.home.index');
Route::prefix('pengaduan')->group(function () {
    Route::get('/', 'PengaduanController@index')->name('frontend.home.pengaduan.index');
    Route::get('/insert', 'PengaduanController@insert')->name('front.home.pengaduan.insert');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/img/{path}', '\App\Http\Controllers\ImageController@show')->where('path', '.*');
