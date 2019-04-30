<?php

Route::group(['middleware' => ['web','Karyawan'], 'prefix' => 'karyawan', 'namespace' => 'Modules\Karyawan\Http\Controllers'], function()
{
	View::composer(['karyawan::layouts.master'],function($view){
		  $notify = DB::table('tbl_submission')->where('id_employee',Auth::user()->id_employee)->where('has_read',0)->where(function($query){
            $query->where('confirm_status','=','Approve')
            ->orWhere('confirm_status','=','Reject');
            })->get();

          $view->with('notify',$notify);

		   $no = 0;
		   foreach ($notify as $photos) {
		   	$no++;
		  	$photo = $photos->approval;

		    $photonya = DB::table('tbl_employee')->where('name',$photo)->get();
		    	if (count($photonya) > 0) {
		   	 	$link_photo[$no] = $photonya[0]->photo;
		   	 	$view->with('link_photo',$link_photo);
		    	}
		   }

	});	
    Route::get('/', 'KaryawanController@index')->name('dashboard');
    Route::post('/clock_in','KaryawanController@clockin')->name('clockin_karyawan');
    Route::patch('/clock_out','KaryawanController@clockout')->name('clockout_karyawan');
    Route::get('/notify/{id}','KaryawanController@notify')->name('notify');

    Route::group(['middleware' => ['web','Karyawan'], 'prefix' => 'cuti'], function()
    {
    Route::get('/buat_pengajuan','KaryawanController@buat')->name('buatpengajuan');
    Route::post('/store_pengajuan','KaryawanController@store_pengajuan')->name('storepengajuan');
    Route::get('/data_pengajuan','KaryawanController@show_pengajuan')->name('datapengajuan');
    Route::get('/hapus_pengajuan/id={id}','KaryawanController@delete_pengajuan');
	});

	Route::group(['middleware' => ['web','Karyawan'], 'prefix' => 'profile'],function(){
		Route::get('/detail','KaryawanController@detail_profile')->name('detailprofile_karyawan');
		Route::patch('/update_profile','KaryawanController@update_profile')->name('updateprofile_karyawan');
		Route::get('/ubah_password', function() {
		    return view('karyawan::profile.change_password');
		})->name('changepassword_karyawan');
		Route::patch('/update_password','KaryawanController@update_password')->name('update_password');
	});

	Route::group(['middleware' => ['web','Karyawan'],'prefix' => 'slipgaji'],function(){
		Route::get('/data','KaryawanController@data_gaji')->name('slipgaji');
	});
	
});
