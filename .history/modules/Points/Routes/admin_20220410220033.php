<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;

Route::get('/','NewsController@index')->name('points.admin.index');
Route::get('/create','NewsController@create')->name('points.admin.create');
Route::get('/edit/{id}', 'NewsController@edit')->name('points.admin.edit');
Route::post('/bulkEdit','NewsController@bulkEdit')->name('points.admin.bulkEdit');
Route::post('/store/{id}','NewsController@store')->name('points.admin.store');

Route::get('/category','CategoryController@index')->name('points.admin.category.index');
Route::get('/category/getForSelect2','CategoryController@getForSelect2')->name('points.admin.category.getForSelect2');
Route::get('/category/edit/{id}','CategoryController@edit')->name('points.admin.category.edit');
Route::post('/category/store/{id}','CategoryController@store')->name('points.admin.category.store');
Route::post('/category/bulkEdit','CategoryController@bulkEdit')->name('points.admin.category.bulkEdit');

Route::get('/tag','TagController@index')->name('points.admin.tag.index');
Route::get('/tag/edit/{id}','TagController@edit')->name('points.admin.tag.edit');
Route::post('/tag/store/{id}','TagController@store')->name('points.admin.tag.store');
Route::post('/tag/bulkEdit','TagController@bulkEdit')->name('points.admin.tag.bulkEdit');
