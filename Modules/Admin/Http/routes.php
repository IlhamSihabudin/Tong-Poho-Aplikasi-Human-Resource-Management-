<?php

Route::group(['middleware' => ['web','Admin'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index')->name('admin_index');

    // Route Profile
    Route::get('/detail','AdminController@detail_profile')->name('admin_detailprofile');
    Route::patch('/update_profile','AdminController@update_profile')->name('admin_updateprofile');
    Route::get('/ubah_password', function() { return view('admin::updatepass');})->name('admin_changepassword');
    Route::patch('/update_password','AdminController@update_password')->name('admin_update_password');

    // Route Employee
    Route::get('/tampildp','AdminController@create')->name('admin_tampil_input');
    Route::post('/inputdp','AdminController@store')->name('admin_simpandp');
    Route::get('/showdp','AdminController@show')->name('admin_showdp');
    Route::get('/hapus/{id}','AdminController@destroy')->name('admin_hapus');
    Route::get('/edit/{id}','AdminController@edit')->name('admin_editdp');
    Route::post('/update/{id}','AdminController@update')->name('admin_update');
    // Route Employee Contract
    Route::get('/showcon','AdminController@showcon')->name('admin_contract');
    Route::get('/editcon/{id}','AdminController@editcon')->name('admin_editcon');
    Route::post('/updatecon/{id}','AdminController@updatecon')->name('admin_updatecon');

    // Route Job
    Route::get('/tampilijob', 'AdminController@createjob')->name('admin_tampil_input_job');
    Route::post('/inputjob','AdminController@inputjob')->name('admin_simpanjob');
    Route::get('/showjob','AdminController@showjob')->name('admin_showjob');
    Route::get('/deletejob/{id}','AdminController@deletejob')->name('admin_delete');
    Route::get('/editjob/{id}','AdminController@editjob')->name('admin_editjob');
    Route::post('/updatejob/{id}','AdminController@updatejob')->name('admin_updatejob');

    // Route Division
    Route::get('/tampildiv', 'AdminController@createdivisi')->name('admin_tampil_input_divisi');
    Route::post('/inputdiv','AdminController@inputdivisi')->name('admin_simpandivisi');
    Route::get('/showdivisi','AdminController@showdivisi')->name('admin_showdivisi');
    Route::get('/deletedivisi/{id}','AdminController@deletedivisi')->name('admin_deletedivisi');
    Route::get('/editdivisi/{id}','AdminController@editdivisi')->name('admin_editdivisi');
    Route::post('/updatedivisi/{id}','AdminController@updatedivisi')->name('admin_updatedivisi');
});
