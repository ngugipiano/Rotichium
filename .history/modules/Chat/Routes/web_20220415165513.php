<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['user', 'verified']], function(){
	Route::get('support-ticket/create', 'SupportTicketController@user_ticket_create')->name('support-tickets.user_ticket_create');
	Route::post('support-ticket/store', 'SupportTicketController@store')->name('support-ticket.store');
	Route::post('support-ticket/user-reply', 'SupportTicketController@ticket_reply')->name('support-ticket.user_reply');
	Route::get('support-ticket/history', 'SupportTicketController@user_index')->name('support-tickets.user_index');
	Route::get('support-ticket/view-details/{id}', 'SupportTicketController@user_view_details')->name('support-tickets.user_view_details');

});
//chat_view
Route::get('/user-chats', 'SystemChatController@admin_chat_index')->name('chat.admin.all');
Route::get('/user-chats/{id}', 'SystemChatController@admin_chat_details')->name('chat_details_for_admin');
