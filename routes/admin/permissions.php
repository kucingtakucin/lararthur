<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PermissionsController@index')->name('backend.admin.permissions.index');
Route::get('/data', 'PermissionsController@data')->name('backend.admin.permissions.data');
Route::post('/insert', 'PermissionsController@insert')->name('backend.admin.permissions.insert');
Route::put('/update', 'PermissionsController@update')->name('backend.admin.permissions.update');
Route::delete('/delete', 'PermissionsController@delete')->name('backend.admin.permissions.delete');
