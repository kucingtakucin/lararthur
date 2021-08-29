<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MahasiswaController@index')->name('backend.admin.mahasiswa.index');
Route::get('/data', 'MahasiswaController@data')->name('backend.admin.mahasiswa.data');
Route::get('/getProdi', 'MahasiswaController@getProdi')->name('backend.admin.mahasiswa.get_prodi');
Route::get('/getFakultas', 'MahasiswaController@getFakultas')->name('backend.admin.mahasiswa.get_fakultas');
Route::get('/getKecamatan', 'MahasiswaController@getKecamatan')->name('backend.admin.mahasiswa.get_kecamatan');
Route::get('/getLatLng', 'MahasiswaController@getLatLng')->name('backend.admin.mahasiswa.get_latlng');
Route::get('/getGeoJson', 'MahasiswaController@getGeoJSON')->name('backend.admin.mahasiswa.get_geojson');
Route::post('/insert', 'MahasiswaController@store')->name('backend.admin.mahasiswa.store');
Route::post('/upload', 'MahasiswaController@upload')->name('backend.admin.mahasiswa.upload');
Route::put('/update', 'MahasiswaController@update')->name('backend.admin.mahasiswa.update');
Route::delete('/delete', 'MahasiswaController@destroy')->name('backend.admin.mahasiswa.destroy');
