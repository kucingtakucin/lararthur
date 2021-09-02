<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'UserController@index')->name('backend.admin.user.index');
Route::get('/data', 'UserController@data')->name('backend.admin.user.data');
Route::get('/getRoles', 'UserController@getRoles')->name('backend.admin.user.get_roles');
Route::get('/getPermissions', 'UserController@getPermissions')->name('backend.admin.user.get_permissions');
Route::post('/insert', 'UserController@insert')->name('backend.admin.user.insert');
Route::put('/update', 'UserController@update')->name('backend.admin.user.update');
Route::delete('/delete', 'UserController@delete')->name('backend.admin.user.delete');
