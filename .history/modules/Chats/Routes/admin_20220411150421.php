<?php
use Illuminate\Support\Facades\Route;

//chat_view
Route::get('/user-chats', 'ChatController@admin_chat_index')->name('chat.admin.all');
Route::get('/user-chats/{id}', 'ChatController@admin_chat_details')->name('chat_details_for_admin');
