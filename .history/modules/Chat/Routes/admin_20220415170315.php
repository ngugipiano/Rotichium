<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/2019
 * Time: 10:02 AM
 */
use Illuminate\Support\Facades\Route;


//chat_view
Route::get('/user-chats', 'SystemChatController@admin_chat_index')->name('chat.admin.all');
Route::get('/user-chats/{id}', 'SystemChatController@admin_chat_details')->name('chat_details_for_admin');

// Support
Route::group(['prefix' => 'support'], function(){

    Route::resource('support-tickets','SupportTicketController');
    Route::get('/my-ticket', 'SupportTicketController@my_ticket')->name('support-tickets.my_ticket');
    Route::get('/solved-ticket', 'SupportTicketController@solved_ticket')->name('support-tickets.solved_ticket');
    Route::get('/active-ticket', 'SupportTicketController@active_ticket')->name('support-tickets.active_ticket');
    Route::post('support-ticket/agent/reply', 'SupportTicketController@ticket_reply')->name('support-ticket.admin_reply');
    Route::get('/support-ticket/destroy/{id}', 'SupportTicketController@destroy')->name('support-tickets.destroy');


    // deafult staff for assigning ticket
    Route::get('/default-ticket-assigned-agent', 'SupportTicketController@default_ticket_assigned_agent')->name('default_ticket_assigned_agent');

    // Support categories
    Route::resource('support-categories','SupportCategoryController');
    Route::get('/support-categories/destroy/{id}', 'SupportCategoryController@destroy')->name('support_categories.destroy');

});
