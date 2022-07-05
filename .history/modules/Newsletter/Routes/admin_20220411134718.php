<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;

Route::get('/','NewsletterController@index')->name('newsletter.admin.index');
Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

