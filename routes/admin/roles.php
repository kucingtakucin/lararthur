<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'RolesController@index')->name('backend.admin.roles.index');
Route::get('/data', 'RolesController@data')->name('backend.admin.roles.data');
Route::post('/insert', 'RolesController@insert')->name('backend.admin.roles.insert');
Route::put('/update', 'RolesController@update')->name('backend.admin.roles.update');
Route::delete('/delete', 'RolesController@delete')->name('backend.admin.roles.delete');
