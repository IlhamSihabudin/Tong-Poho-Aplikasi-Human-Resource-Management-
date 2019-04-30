<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\NotPresent;
use App\ForgotAbsent;
use App\Reason;
use DB;
use Auth;
use File;
use Storage;

class ApiController extends Controller
{
    public function login(Request $request)
    {
    	if (Auth::attempt(['email' => $request->email,'password' => $request->password])) {
    		$employee[] = Auth::user();
    		return response()->json(['code'=>'200','message'=>'Login Success','user'=>$employee]);
    	}
    	else{
    		return response()->json(['code'=>'400','message'=>'Login Failed']);
    	}
    }

    public function My_Profile($id)
    {
		$data = DB::table('tbl_employee')
		->join('tbl_job','tbl_employee.id_job','=','tbl_job.id_job')
		->select('tbl_employee.*','tbl_job.job')
		->join('tbl_division','tbl_employee.id_division','=','tbl_division.id_division')
		->select('tbl_employee.*','tbl_job.job','tbl_division.division')
		->where('id_employee',$id)->get();

        return response()->json(['code'=>'200','user'=>$data]);
    }

    public function ForgotAbsent(Request $request)
    {
    	if ($request->hasfile('attachment') || $request->attachment != null) {
    		if ($request->file('attachment')->getClientSize() == false) {
    			return response()->json(['code'=>'400','message'=>'File To Large !']);
    		}else{

    		$file = $request->file('attachment');
    		$name_file = date('Y-m-d').'-'.rand().'.'.$file->getClientOriginalExtension();
    		// // $path = public_path('/file/');
    		// $file->move($path,$name_file,File::get($file));

            Storage::disk('public')->put($name_file,File::get($file));

    		$data = ForgotAbsent::create([
    		"id_employee" => $request->id_employee,
    		"date" => $request->date,
    		"attachment" => $name_file,
    		"statement" => $request->statement
    		]);

    		return response()->json(['code'=>'200','message'=>'Success']);
    		}

    	}
    	else{
    		return response()->json(['code'=>'400','message'=>'Failed']);
    	}
    }

    public function GetReason()
    {
    	$data = Reason::all();

    	return response()->json(['code'=>'200','reason'=>$data]);
    }

    public function NotPresent(Request $request)
    {
    	if ($request->hasfile('attachment') || $request->attachment != null) {
    		if ($request->file('attachment')->getClientSize() == false) {
    			return response()->json(['code'=>'401','message'=>'File To Large !']);
    		}else{

    		$file = $request->file('attachment');
    		$name_file = date('Y-m-d').'-'.rand().'.'.$file->getClientOriginalExtension();
    		// $path = public_path('/file/');
    		// $file->move($path,$name_file);
            Storage::disk('public')->put($name_file,File::get($file));

            $reasonable = Reason::where('reason',$request->reason)->first();


    		$data = NotPresent::create([
    		"id_reason" => $reasonable->id_reason,
    		"id_employee" => $request->id_employee,
    		"statement" => $request->statement,
    		"date_start" => $request->date_start,
    		"date_end" => $request->date_end,
    		"destination_address" => $request->destination_address,
    		"attachment" => $name_file
    		]);

    		return response()->json(['code'=>'200','message'=>'Success']);
            }
    	}
    	else{
    		return response()->json(['code'=>'400','message'=>'Failed']);
    	}

    	
    }

}

