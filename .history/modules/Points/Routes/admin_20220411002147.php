<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;

Route::get('/','ClubPointController@index')->name('points.admin.index');
Route::get('/item_point','ClubPointController@item_point')->name('points.admin.item_point');
Route::get('/edit/{id}', 'ClubPointController@edit')->name('points.admin.edit');
Route::post('/bulkEdit','ClubPointController@bulkEdit')->name('points.admin.bulkEdit');
Route::post('/store/{id}','ClubPointController@store')->name('points.admin.store');
