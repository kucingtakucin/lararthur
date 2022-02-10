<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('backend.operator.dashboard.index');
