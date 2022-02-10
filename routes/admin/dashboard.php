<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('backend.admin.dashboard.index');
