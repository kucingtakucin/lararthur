<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MahasiswaController@index')->name('backend.admin.mahasiswa.index');
Route::get('/data', 'MahasiswaController@data')->name('backend.admin.mahasiswa.data');
Route::get('/getProdi', 'MahasiswaController@getProdi')->name('backend.admin.mahasiswa.get_prodi');
Route::get('/getFakultas', 'MahasiswaController@getFakultas')->name('backend.admin.mahasiswa.get_fakultas');
Route::get('/getKecamatan', 'MahasiswaController@getKecamatan')->name('backend.admin.mahasiswa.get_kecamatan');
Route::get('/getLatLng', 'MahasiswaController@getLatLng')->name('backend.admin.mahasiswa.get_latlng');
Route::get('/getGeoJson', 'MahasiswaController@getGeoJSON')->name('backend.admin.mahasiswa.get_geojson');
Route::get('/exportWord', 'MahasiswaController@exportWord')->name('backend.admin.mahasiswa.export_word');
Route::get('/exportExcel', 'MahasiswaController@exportExcel')->name('backend.admin.mahasiswa.export_excel');
Route::get('/exportPdf', 'MahasiswaController@exportPdf')->name('backend.admin.mahasiswa.export_pdf');
Route::post('/insert', 'MahasiswaController@insert')->name('backend.admin.mahasiswa.insert');
Route::post('/upload', 'MahasiswaController@upload')->name('backend.admin.mahasiswa.upload');
Route::put('/update', 'MahasiswaController@update')->name('backend.admin.mahasiswa.update');
Route::delete('/delete', 'MahasiswaController@delete')->name('backend.admin.mahasiswa.delete');
