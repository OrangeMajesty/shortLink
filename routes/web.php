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
    return view('start');
});

Route::get('link/{short}', 'linkGenerator@redirectToFull')->name('redirectToFull');

Route::post('submitLink', 'linkGenerator@index')->name('mklink');
