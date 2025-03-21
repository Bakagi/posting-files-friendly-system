<?php

use Dom\Attr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

Route::get('/', 'App\Http\Controllers\AppController@index');
Route::get('/load', 'App\Http\Controllers\AppController@load');

Route::post('/', 'App\Http\Controllers\AppController@create');
Route::get('/{file}', 'App\Http\Controllers\AppController@read');
Route::post('/{file}', 'App\Http\Controllers\AppController@update');
Route::delete('/{file}', 'App\Http\Controllers\AppController@destroy');



