<?php

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

Route::get('/','PageController@index');

Route::get('/master','PageController@master');

Route::post('/master','PageController@postMenuMaster');

Route::post('/','PageController@postWeeklyMenu');

Route::post('/add','PageController@postEditMenuList');

Route::post('/edit','PageController@postEditViewMenuList');

Route::post('/editsave','PageController@postEditSaveWeeklyMenu');
