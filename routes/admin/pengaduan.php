<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PengaduanController@index')->name('backend.admin.pengaduan.index');
Route::get('/data', 'PengaduanController@data')->name('backend.admin.pengaduan.data');
Route::get('/chat/{id}', 'PengaduanController@chat')->name('backend.admin.pengaduan.chat');
