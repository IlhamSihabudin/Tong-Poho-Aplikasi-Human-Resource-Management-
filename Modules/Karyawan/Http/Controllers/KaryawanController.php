<?php

namespace Modules\Karyawan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Modules\Karyawan\Entities\Absent;
use Auth;
use Modules\Karyawan\Entities\Pengajuan;
use Alert;
use Modules\Karyawan\Entities\Employee;
use Hash;
use File;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function __construct()
    {
        $this->middleware('auth');


    }


    public function index()
    {  

        //Birthday
        $employee_birthday = Employee::whereMonth('birth_date', '=',Carbon::now()->format('m'))->whereDay('birth_date', '=', Carbon::now()->format('d'))->get();
        $photo_birthday = ['birth-img-4.png','birth-img-2.png','birth-img-3.png']; 
        //EndBirthday

        //Session Show button Clock_In
        $id = Auth::user()->id_employee;
        $only_date_now = substr(Carbon::today(),0,10);
        $cek_id_in = DB::table('tbl_absent')->where('id_employee',$id)
        ->whereDate('clock_in',$only_date_now);

        $count = count($cek_id_in->get());
        if ($count == 1) {
            $date_clockin = substr($cek_id_in->first()->clock_in,0,10);
        }
        else{
            $date_clockin = "";
        }

        $jam_masuk = "07:00:00";

        $max_clockin = "12:00:00";

        //EndClock-IN

        //Name of Day to Number 1-7
        $day = date('N');
        //ENDDAY
        
        //Session Show button Clock out
        $cek_id_out = DB::table('tbl_absent')->where('id_employee',$id)
        ->whereDate('clock_out',$only_date_now);

        $count_out = count($cek_id_out->get());
        if ($count_out == 1) {
            $date_clockout = substr($cek_id_out->first()->clock_out,0,10);
        }
        else{
            $date_clockout = "";
        }

        $time_now = substr(Carbon::now(),11);
        $jam_keluar = "16:30:00";
        $max_clockout = "23:59:00";
        //EndClockout

        return view('karyawan::index',['date_now'=>$only_date_now,'date_clockin'=>$date_clockin,'count'=>$count,'jam_masuk'=>$jam_masuk,'max_clockin'=>$max_clockin,'only_time'=>$time_now,'jam_keluar' => $jam_keluar,'date_clockout'=>$date_clockout,'max_clockout'=>$max_clockout,'hari'=>$day,'birthday'=>$employee_birthday,'photo_birthday'=>$photo_birthday]);
        
    }

    public function clockin()
    {

        $clockin = Carbon::now();
        $clockin = new Carbon();

        $id_employee = Auth::user()->id_employee;

        $data = Absent::create([
        'id_employee' => $id_employee,
        'clock_in' => $clockin,
        'clock_out' => NULL,
        'absent_status' => 'Hadir',
        ]);

        Alert::success('Thanks You Have ClockIn','Success');

        return back();
    }

    public function clockout()
    {
        $clockout = Carbon::now();

        $id = Auth::user()->id_employee;
        $only_date_now = substr(Carbon::today(),0,10);
        $cek_id = DB::table('tbl_absent')->where('id_employee',$id)
        ->whereDate('clock_in',$only_date_now)
        ->first();

        DB::table('tbl_absent')
            ->where('id_absent',$cek_id->id_absent)
            ->update(['clock_out' => $clockout]);

        Alert::success('Thanks You Have ClockOut','Success');

        return back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function buat()
    {
      $id_employee = Auth::user()->id_employee;
      $jumlah_cuti = DB::table('tbl_employee')->where('id_employee',$id_employee)->first();
      
      return view('karyawan::buat_pengajuan',['jumlah_cuti'=>$jumlah_cuti]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store_pengajuan(Request $request)
    {
      $id_employee = Auth::user()->id_employee;
      $jumlah_cuti = DB::table('tbl_employee')->where('id_employee',$id_employee)->first();

      $date = date('Y-m-d');

      if ($request->jenis_cuti == "Sakit") {

      $tgl_mulai = Carbon::parse($request->tgl_mulai2);
      $tgl_berakhir = Carbon::parse($request->tgl_berakhir2);
      $total_days = $tgl_mulai->diffInDays($tgl_berakhir) + 1;

        if (($jumlah_cuti->number_of_leave - $total_days) < 0) {
          alert()->error('The Rest of Your Leave '.$jumlah_cuti->number_of_leave.' Days anymore','Failed !')->persistent();
          return back();
          }
        else{
           $request->validate([
          'jenis_cuti' => 'required',
          'keterangan' => 'required',
          'tgl_mulai2_submit' => 'required|date',
          'tgl_berakhir2_submit' => 'required|date'
         ]);

          $pengajuan = Pengajuan::create([
            'id_employee' => $id_employee,
            'leave_type' => $request->jenis_cuti,
            'date_submission' => $date,
            'statement' => $request->keterangan,
            'date_begin' => $request->tgl_mulai2_submit,
            'date_end' => $request->tgl_berakhir2_submit,
            'total_of_leave' => $total_days,
            'confirm_status' => 'Pending'
          ]);
          Alert::success('Your Submission of Leave Has been Sent','Success');
          return redirect(route('datapengajuan'));
          }
      }
      else{

      $request->validate([
        'jenis_cuti' => 'required',
        'keterangan' => 'required',
        'tgl_mulai_submit' => 'required|date',
        'tgl_berakhir_submit' => 'required|date'
      ]);

        $tgl_mulai = Carbon::parse($request->tgl_mulai);
        $tgl_berakhir = Carbon::parse($request->tgl_berakhir);
        $total_days = $tgl_mulai->diffInDays($tgl_berakhir) + 1;

        if (($jumlah_cuti->number_of_leave - $total_days) < 0) {
          alert()->error('The Rest of Your Leave '.$jumlah_cuti->number_of_leave.' Days anymore','Failed !')->persistent();
        return back();
        }
        else{
          $pengajuan = Pengajuan::create([
            'id_employee' => $id_employee,
            'leave_type' => $request->jenis_cuti,
            'date_submission' => $date,
            'statement' => $request->keterangan,
            'date_begin' => $request->tgl_mulai_submit,
            'date_end' => $request->tgl_berakhir_submit,
            'total_of_leave' => $total_days,
            'confirm_status' => 'Pending'
          ]);
          Alert::success('Your Submission of Leave Has been Sent','Success');
          return redirect(route('datapengajuan'));  
        }
      }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show_pengajuan()
    {
        $id_employee = Auth::user()->id_employee;
        $data = DB::table('tbl_submission')->where('id_employee',$id_employee)->paginate(10);
        $jumlah_cuti = DB::table('tbl_employee')->where('id_employee',$id_employee)->first();
        $sisa_cuti = $jumlah_cuti->number_of_leave;
        return view('karyawan::cuti.data_pengajuan',['data'=>$data,'sisa_cuti'=>$sisa_cuti]);
    }

    public function delete_pengajuan($id)
    {
      $id_submission = Pengajuan::find($id);

      $id_submission->delete();
      Alert::success('Your Submission Has Been Deleted','Success');
      return back();
     
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function detail_profile()
    {
        $id = Auth::user()->id_employee;
        $data = Employee::find($id);

        $job = DB::table('tbl_job')->where('id_job',$data->id_job)->first();
        $division = DB::table('tbl_division')->where('id_division',$data->id_division)->first();
       
        $gender = $data->gender;

        if ($gender == "P") {
            $female = "checked";
            $male = "";
        }
        else{
            $male = "checked";
            $female = "";
        }

        $tgl_lahir = date('d F Y',strtotime($data->birth_date));
        return view('karyawan::profile.detail_profile',['data'=>$data,'tgl_lahir'=>$tgl_lahir,'male_check'=>$male,'female_check'=>$female,'job'=>$job,'division'=>$division]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function update_profile(Request $request)
    {
       $id_employee = Employee::find(Auth::user()->id_employee);

       $request->validate([
        'name' => 'required',
        'gender' => 'required',
        'birth_place' => 'required'
       ]);

       if ($request->email != $id_employee->email) {
          $request->validate([
          'name'=> 'required',
          'gender' => 'required',
          'birth_place' => 'required',
          'birth_date_submit' => 'required',
          'email' => 'required|email|unique:tbl_employee'
          ]);
       }

        if ($request->hasfile('image')) {

           if ($request->email != $id_employee->email) {
            $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2000',
            'name'=> 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date_submit' => 'required',
            'email' => 'required|email|unique:tbl_employee'
            ]);
          }
          $request->validate([
          'image' => 'required|image|mimes:jpg,png,jpeg|max:2000',
          'name'=> 'required',
          'gender' => 'required',
          'birth_place' => 'required',
          'birth_date_submit' => 'required',
          'email' => 'required|email'
          ]);

        $img = $request->file('image');
        $name_img = date('Y-m-d').'-'.rand().'.'.$img->getClientOriginalExtension();
        $path = public_path('/upload');
        File::delete($path.'/'.$id_employee->photo);
        $img->move($path,$name_img);
         $data = [
        'name' => $request->name,
        'gender' => $request->gender,
        'birth_place' => $request->birth_place,
        'birth_date' => $request->birth_date_submit,
        'email' => $request->email,
        'photo' => $name_img
         ];

        }
        else
        {
         $data = [
        'name' => $request->name,
        'gender' => $request->gender,
        'birth_place' => $request->birth_place,
        'birth_date' => $request->birth_date_submit,
        'email' => $request->email
         ];

        }


       $id_employee->update($data);

       Alert::success('Your Profile Has Been Updated','Success');
       return back();
    }



    public function update_password(Request $request)
    {
      $id_employee = Employee::find(Auth::user()->id_employee);

      $old_pass = Auth::user()->password;

       $request->validate([
        'last_password' => 'required',
        'new_password' => 'required|string|min:6',
        'confirm_password' => 'required|same:new_password'
      ]);

      if (!Hash::check($request->last_password, $old_pass)) {
          Alert::error('Wrong Last Password','Error');
          return back();
      }
      else{
      $pass = [
        'password' => Hash::make($request->confirm_password)
      ];


      $id_employee->update($pass);
      }
      
      Alert::success('Your Password Has Been Updated','Success');

      return back();

      }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function data_gaji()
    {
      $id_employee = Auth::user()->id_employee;
      $id_job = Auth::user()->id_job;
      $id_division = Auth::user()->id_division;

      $job = DB::table('tbl_job')->where('id_job',$id_job)->first();
      $division = DB::table('tbl_division')->where('id_division',$id_division)->first();


      $penghasilan = DB::table('tbl_employee')
                     ->join('tbl_tmp_allowance','tbl_employee.id_employee','=','tbl_tmp_allowance.id_employee')
                     ->join('tbl_allowance','tbl_allowance.id_allowance','=','tbl_tmp_allowance.id_allowance')
                     ->select('tbl_employee.id_employee','tbl_allowance.allowance_title','tbl_allowance.allowance_amount')->where('tbl_employee.id_employee',$id_employee)->get();
      $total = $penghasilan->sum('allowance_amount') + $job->salary;

      return view('karyawan::slip_gaji.data_slip_gaji',['id_employee'=>$id_employee,'job'=>$job,'division'=>$division,'penghasilan'=>$penghasilan,'total'=>$total]);
    }

    public function notify($id)
    {
      $id_notify = Pengajuan::find($id);

      $data = [
        'has_read' => '1'
      ];

      $id_notify->update($data);

      return redirect(route('datapengajuan'));
    }
}
