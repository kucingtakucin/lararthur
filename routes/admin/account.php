<?php

use Illuminate\Support\Facades\Route;

Route::post('/', 'AccountController@update')->name('backend.admin.account.update');
