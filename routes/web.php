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

Auth::routes();

Route::namespace('Links')->group(function () {
    Route::get('/', 'IndexController')->name('home');
    Route::get('/{link}', 'RedirectController')->name('redirect');
    Route::post('/create', 'CreateController')->name('create');
    Route::get('/delete/{id}', 'DeleteController')->name('delete');
});

