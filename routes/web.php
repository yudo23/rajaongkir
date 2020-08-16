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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','RajaApiController@index');

// Route::get('/rajaongkir/wilayah','RajaOngkirController@wilayah');
// Route::get('/rajaongkir/kota','RajaOngkirController@kota');


Route::get('/rajaapi/provinsi','RajaApiController@rajaapi_get_provinsi');
Route::get('/rajaapi/kota','RajaApiController@rajaapi_get_kota');
Route::get('/rajaapi/kecamatan','RajaApiController@rajaapi_get_kecamatan');
Route::get('/rajaapi/kelurahan','RajaApiController@rajaapi_get_kelurahan');
