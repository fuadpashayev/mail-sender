<?php


Route::get('/','HomeController@index')->name('views.home');
Route::get('/login','HomeController@login')->name('views.login');
Route::get('/register','HomeController@register')->name('views.register');


Route::post('/login','UserController@login')->name('user.login');
Route::post('/register','UserController@register')->name('user.register');
Route::get('/logout','UserController@logout')->name('user.logout');


Route::group(['middleware' => 'UserMiddleware'],function(){
    Route::post('/sender/create','SenderController@create')->name('sender.create');
    Route::get('/sender/{id}','SenderController@show')->name('sender.show');
    Route::get('/sender/{id}/edit','SenderController@edit')->name('sender.edit');
    Route::post('/sender/{id}/update','SenderController@update')->name('sender.update');
    Route::get('/sender/{id}/delete','SenderController@delete')->name('sender.delete');
});

Route::get('/verification/{token}','UserController@verification')->name('user.verify');

Route::post('mail/send', 'MailController@sendVerificationMail')->name('user.send.mail');

