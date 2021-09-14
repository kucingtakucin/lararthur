<?php

use Illuminate\Support\Facades\Route;

Route::post('/', 'PengaduanController@index')->name('backend.admin.pengaduan.index');
Route::post('/data', 'PengaduanController@data')->name('backend.admin.pengaduan.data');
Route::post('/chat/{id}', 'PengaduanController@chat')->name('backend.admin.pengaduan.chat');
