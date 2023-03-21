<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Outlet
Route::resource('outlet','OutletController');
Route::get('/outlet/edit/{id}','OutletController@getEditPage');
Route::post('/outlet-save-edit','OutletController@save_edit');
Route::post('/outlet-dalete/{id}','OutletController@deleteData');

// Produk
Route::resource('produk','ProdukController');
Route::get('/produk/edit/{id}','ProdukController@getEditPage');
Route::post('/produk-save-edit','ProdukController@save_edit');
Route::post('/produk-dalete/{id}','ProdukController@deleteData');

// Diskon
Route::resource('diskon','DiskonController');

// Order
Route::resource('order','OrderController');
Route::get('/cetak-laporan-order/{id}','OrderController@printReport');