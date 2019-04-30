<?php 

 $notify = DB::table('tbl_submission')->where('id_employee',Auth::user()->id_employee)
                  ->where(function($query){
                    $query->where('confirm_status','=','Approve')
                          ->orWhere('confirm_status','=','Reject');
                  })->get();
 $notify->count();

 ?>