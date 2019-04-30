<?php

Route::group(['middleware' => ['web', 'Manager'], 'prefix' => 'manager', 'namespace' => 'Modules\Manager\Http\Controllers'], function()
{
    View::composer(['manager::layouts.master'],function($view){
        $notify = DB::table('tbl_submission')
            ->join('tbl_employee','tbl_submission.id_employee', '=','tbl_employee.id_employee')
            ->select('tbl_employee.name','tbl_submission.*')
            ->where('tbl_submission.confirm_status', 'Pending')
            ->where('tbl_employee.id_division', '=', @Auth::user()->id_division)
            ->get();

        if (date('N') != 6 || date('N') != 7){
            if (date('H:i') > date('H:i', strtotime('12:00'))){
                $employee_data = DB::table('tbl_employee')->select('id_employee')->get();
                for ($i=0;$i<count($employee_data);$i++){
                    $employee[$i] = $employee_data[$i]->id_employee;
                }
                $absent_data = DB::table('tbl_absent')
                    ->where('clock_in', 'LIKE', '%'. date('Y-m-d') .'%')
                    ->select('id_employee')
                    ->get();
                for ($i=0;$i<count($absent_data);$i++){
                    $absent[$i] = $absent_data[$i]->id_employee;
                }

                if (count($absent_data) > 0){
                    $id_belum_clockin = array_diff($employee, $absent);

                    foreach ($id_belum_clockin as $item){
                        \Modules\Manager\Entities\AbsentManager::create([
                            'id_employee' => $item,
                            'clock_in' => date('Y-m-d'),
                            'clock_out' => date('Y-m-d'),
                            'absent_status' => 'Alpa'
                        ]);
                    }
                }
            }
        }
        $view->with(['notify'=>$notify]);
    });

    Route::get('/', 'ManagerController@index')->name('home_manager');
    Route::post('/clock_in','ManagerController@clockin')->name('clockin_manager');
    Route::patch('/clock_out','ManagerController@clockout')->name('clockout_manager');

    Route::group(['middleware' => ['web', 'Manager'], 'prefix' => 'tunjangan'], function (){
        Route::get('/','ManagerController@show')->name('tunjangan');
        Route::get('/input', 'ManagerController@create')->name('input_tunjangan');
        Route::post('/simpan', 'ManagerController@store')->name('simpan_tunjangan');
        Route::get('/hapus/{id}', 'ManagerController@destroy');
        Route::get('/edit/{id}', 'ManagerController@edit');
        Route::post('/edit/{id}', 'ManagerController@update');

        Route::get('/detail', 'BagitunjanganController@detail')->name('detail');
        Route::post('/detail/input', 'BagitunjanganController@store')->name('bagi_tunjangan');
        Route::get('/detail/hapus/{id}', 'BagitunjanganController@destroy');
    });

    Route::group(['middleware' => ['web','Manager'], 'prefix' => 'riwayat_cuti'], function (){
       Route::get('/', 'ManagerController@riwayat')->name('riwayat');
       Route::get('/detail/{id}', 'ManagerController@detail_riwayat');
    });

    Route::group(['middleware' => ['web','Manager'], 'prefix' => 'notifikasi'], function (){
        Route::get('/', 'ManagerController@notifikasi')->name('notifikasi_manager');
        Route::get('/applied', 'ManagerController@applied')->name('applied_manager');
        Route::get('/approved', 'ManagerController@approved')->name('approved_manager');
        Route::get('/rejected', 'ManagerController@rejected')->name('rejected_manager');
        Route::get('/approve/{id}', 'ManagerController@approve')->name('approve_manager');
        Route::get('/reject/{id}', 'ManagerController@reject')->name('reject_manager');
    });

    Route::group(['middleware' => ['web','Manager'], 'prefix' => 'profile'],function(){
        Route::get('/detail','ManagerController@profile_detail')->name('detail_profile');
        Route::patch('/update_profile','ManagerController@profile_update')->name('update_profile');
    });

    Route::group(['middleware' => ['web','Manager'], 'prefix' => 'absen'], function (){
       Route::get('/', 'ManagerController@absen')->name('absen');
       Route::get('/export_excel', 'ManagerController@export')->name('export');
       Route::get('/report_absen', 'ManagerController@report_absen')->name('report_absen');
    });

    Route::group(['middleware' => ['web','Manager'], 'prefix' => 'change_password'], function (){
        Route::view('/', 'manager::change_password.index')->name('change_password_manager');
        Route::post('/ubah', 'ManagerController@ubah_password')->name('ubah');
    });
});
