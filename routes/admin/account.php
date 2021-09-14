<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AccountController@update')->name('backend.admin.account.update');
