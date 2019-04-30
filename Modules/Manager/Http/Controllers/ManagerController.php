<?php

namespace Modules\Manager\Http\Controllers;

use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\Manager\Entities\AbsentManager;
use Modules\Manager\Entities\TmpTunjangan;
use Modules\Manager\Entities\Tunjangan;
use Modules\Manager\Entities\Employee;
use Session;
use Auth;
use Alert;
use DateTime;
use DateTimeZone;
use File;

class ManagerController extends Controller
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
        //Session Show button Clock_In
        $id = Auth::user()->id_employee;
        $only_date_now = date('Y-m-d');
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

        $time_now = date('H:i:s');
        $jam_keluar = "16:30:00";
        $max_clockout = "23:59:00";
        //EndClockout


        //Show Employee
        $employee = Employee::all()->where('id_job','!=','1')->count();
        $date = date('Y-m-d');
        $absensi = DB::table('tbl_absent')
            ->join('tbl_employee','tbl_absent.id_employee','tbl_employee.id_employee')
            ->select('tbl_employee.name','tbl_absent.*')
            ->where('absent_status','Hadir')
            ->where('clock_in','LIKE','%'.$date.'%')
            ->orderBy('id_absent','DESC')
            ->get();


        $absens = DB::table('tbl_absent')
            ->where('clock_in','LIKE','%'.$date.'%')
            ->get();
        $sakit = $absens->where('absent_status','Sakit')->count();
        $izin = $absens->where('absent_status','Izin')->count();
        $data = $absens->where('absent_status','Hadir');
        $clockin = $data->count();

        $belum_clockin = $employee - $clockin;

        $telat = 0;
        foreach ($data as $item){
            $clock_in = explode(":", substr($item->clock_in,'11'));
            $jam_menit = $clock_in[0].$clock_in[1];
            if ($jam_menit > 930){
                $telat = $telat+1;
            }
        }

        return view('manager::index',['date_now'=>$only_date_now,'date_clockin'=>$date_clockin,'count'=>$count,'jam_masuk'=>$jam_masuk,'max_clockin'=>$max_clockin,'only_time'=>$time_now,'jam_keluar' => $jam_keluar,'date_clockout'=>$date_clockout,'max_clockout'=>$max_clockout,'hari'=>$day,'sum_employee'=>$employee,'absen'=>$absensi,'izin'=>$izin, 'sakit'=>$sakit, 'telat'=>$telat, 'clockin'=>$clockin, 'belum_clockin'=>$belum_clockin]);
    }

    public function clockin()
    {

        $clockin = Carbon::now();

        $id_employee = Auth::user()->id_employee;

        AbsentManager::create([
            'id_employee' => $id_employee,
            'clock_in' => $clockin,
            'clock_out' => NULL,
            'absent_status' => 'Hadir',
        ]);

        Alert::success('Terima Kasih! Anda Sudah Melakukan Clock In', 'Sukses');
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

        Alert::success('Terima Kasih! Anda Sudah Melakukan Clock Out', 'Sukses');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('manager::tunjangan.input');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate( [
            'nama_tunjangan' => 'required',
            'jumlah_tunjangan' => 'required',
        ]);

        Tunjangan::create([
            'allowance_title' => $request->nama_tunjangan,
            'allowance_amount' => $request->jumlah_tunjangan,
        ]);

        Alert::success('Data Berhasil Di Tambahkan', 'Sukses');
        return redirect(route('tunjangan'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        $data = Tunjangan::all();
        $karyawan = Employee::all()
            ->where('id_job','!=','1')
            ->where('id_job','!=','2')
            ->where('id_division','=', Auth::user()->id_division);

        return view('manager::tunjangan.index', ['data' => $data, 'karyawan'=>$karyawan]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $ids = base64_decode($id);
        $edit = Tunjangan::find($ids);
        return view('manager::tunjangan.edit', ['edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        $ids = base64_decode($id);
        $request->validate([
            'nama_tunjangan' => 'required',
            'jumlah_tunjangan' => 'required',
        ]);

        $data = Tunjangan::find($ids);
        $data->update([
            'allowance_title' => $request->nama_tunjangan,
            'allowance_amount' => $request->jumlah_tunjangan,
        ]);

        Alert::success('Data Berhasil Di Update', 'Sukses');
        return redirect(route('tunjangan'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $ids = base64_decode($id);

        Tunjangan::destroy('id_allowance', $ids);
        DB::table('tbl_tmp_allowance')->where('id_allowance', '=', $ids)->delete();

        Alert::success('Data Berhasil Di Hapus', 'Sukses');
        return back()->with('pesan', 'Data Berhasil Di Hapus');
    }

    // Riwayat Cuti
    public function riwayat()
    {
        $karyawan = DB::table('tbl_employee')
            ->join('tbl_job','tbl_employee.id_job', '=', 'tbl_job.id_job')
            ->join('tbl_division','tbl_division.id_division', '=', 'tbl_employee.id_division')
            ->select('tbl_employee.id_employee', 'tbl_employee.name', 'tbl_employee.gender', 'tbl_job.job', 'tbl_division.division')
            ->where('tbl_employee.id_job','!=','1')
            ->where('tbl_employee.id_job','!=','2')
            ->where('tbl_employee.id_division','=', Auth::user()->id_division)
            ->get();

        $no = 0;
       
        foreach ($karyawan as $item){
            $no++;
            $izin[$no] = AbsentManager::where('id_employee',$item->id_employee)->where('absent_status','Izin')->count();
            $sakit[$no] = AbsentManager::where('id_employee',$item->id_employee)->where('absent_status','Sakit')->count();
            }
        
        return view('manager::riwayat_cuti.index', ['karyawan'=>$karyawan, 'izin'=>@$izin, 'sakit'=>@$sakit]);
    }

    public function detail_riwayat($id)
    {
        $ids = base64_decode($id);
        $data = Employee::find($ids);
        $job = DB::table('tbl_job')->where('id_job', $data->id_job)->get();
        $division = DB::table('tbl_division')->where('id_division', $data->id_division)->get();
        $sakit = AbsentManager::all()->where('id_employee', $ids)->where('absent_status','Sakit');
        $izin = AbsentManager::all()->where('id_employee', $ids)->where('absent_status','Izin');
        return view('manager::riwayat_cuti.detail_riwayat', ['data'=>$data, 'jobs'=>$job, 'divisions'=>$division, 'sakit'=>$sakit, 'izin'=>$izin]);
    }

    // Notifikasi
    public function notifikasi()
    {
        $data = DB::table('tbl_submission')
            ->join('tbl_employee','tbl_submission.id_employee', '=','tbl_employee.id_employee')
            ->select('tbl_employee.name','tbl_submission.*')
            ->where('tbl_employee.id_division', '=', Auth::user()->id_division)
            ->get();

        $applied = $data->count();
        $approved = $data->where('confirm_status','=', 'Approve')->count();
        $rejected = $data->where('confirm_status','=', 'Reject')->count();
        $data_pending = $data->where('confirm_status','=', 'Pending');
        $pending = $data_pending->count();

        return view('manager::notifikasi.index',['applied'=>$applied,'approved'=>$approved,'rejected'=>$rejected,'pending'=>$pending,'data_pending'=>$data_pending]);
    }

    public function applied()
    {
        $data = DB::table('tbl_submission')
            ->join('tbl_employee','tbl_submission.id_employee', '=','tbl_employee.id_employee')
            ->select('tbl_employee.name','tbl_submission.*')
            ->where('tbl_employee.id_division', '=', Auth::user()->id_division)
            ->get();

        $data_applied = $data;
        $applied = $data->count();
        $approved = $data->where('confirm_status','=', 'Approve')->count();
        $rejected = $data->where('confirm_status','=', 'Reject')->count();
        $pending = $data->where('confirm_status','=', 'Pending')->count();

        return view('manager::notifikasi.applied',['applied'=>$applied,'approved'=>$approved,'rejected'=>$rejected,'pending'=>$pending,'data_applied'=>$data_applied]);
    }

    public function approved()
    {
        $data = DB::table('tbl_submission')
            ->join('tbl_employee','tbl_submission.id_employee', '=','tbl_employee.id_employee')
            ->select('tbl_employee.name','tbl_submission.*')
            ->where('tbl_employee.id_division', '=', Auth::user()->id_division)
            ->get();

        $applied = $data->count();
        $data_approved = $data->where('confirm_status','=', 'Approve');
        $approved = $data_approved->count();
        $rejected = $data->where('confirm_status','=', 'Reject')->count();
        $pending = $data->where('confirm_status','=', 'Pending')->count();

        return view('manager::notifikasi.approved',['applied'=>$applied,'approved'=>$approved,'rejected'=>$rejected,'pending'=>$pending,'data_approved'=>$data_approved]);
    }

    public function rejected()
    {
        $data = DB::table('tbl_submission')
            ->join('tbl_employee','tbl_submission.id_employee', '=','tbl_employee.id_employee')
            ->select('tbl_employee.name','tbl_submission.*')
            ->where('tbl_employee.id_division', '=', Auth::user()->id_division)
            ->get();

        $applied = $data->count();
        $approved = $data->where('confirm_status','=', 'Approve')->count();
        $data_rejected = $data->where('confirm_status','=', 'Reject');
        $rejected = $data_rejected->count();
        $pending = $data->where('confirm_status','=', 'Pending')->count();

        return view('manager::notifikasi.rejected',['applied'=>$applied,'approved'=>$approved,'rejected'=>$rejected,'pending'=>$pending,'data_rejected'=>$data_rejected]);
    }

    public function approve($id)
    {
        $ids = base64_decode($id);
        $data = DB::table('tbl_submission')
            ->where('id_submission', '=',$ids)
            ->get();

        $date_mulai = $data[0]->date_begin;
        $date_selesai = $data[0]->date_end;
        $date_begin = new DateTime($date_mulai, new DateTimeZone("Asia/Jakarta"));
        $date_end = new DateTime($date_selesai, new DateTimeZone("Asia/Jakarta"));

        while ($date_begin <= $date_end) {
            $data_absen = DB::table('tbl_absent')->where('clock_in', 'LIKE', '%'.$date_begin->format('Y-m-d').'%')->get();
            if (count($data_absen) > 0){
                DB::table('tbl_absent')
                    ->where('clock_in', 'LIKE', '%'.$date_begin->format('Y-m-d').'%')
                    ->update([
                        'id_employee' => $data[0]->id_employee,
                        'clock_in' => $date_begin,
                        'clock_out' => $date_begin,
                        'absent_status' => $data[0]->leave_type
                    ]);
            }else{
                AbsentManager::create([
                    'id_employee' => $data[0]->id_employee,
                    'clock_in' => $date_begin,
                    'clock_out' => $date_begin,
                    'absent_status' => $data[0]->leave_type
                ]);
            }

            $date_begin->modify("+1 day");
        }

        $hari_ini = date('Y-m-d H:i:s');
        DB::table('tbl_submission')
            ->where('id_submission','=',$ids)
            ->update(['confirm_status'=>'Approve', 'date_approve'=> $hari_ini, 'approval'=> Auth::user()->name]);

        Alert::success('Pengajuan Berhasil Di Approve', 'Sukses');
        return back();
    }

    public function reject($id)
    {
        $ids = base64_decode($id);
        DB::table('tbl_submission')
            ->where('id_submission','=',$ids)
            ->update(['confirm_status'=>'Reject']);

        $hari_ini = date('Y-m-d H:i:s');
        DB::table('tbl_submission')
            ->where('id_submission','=',$ids)
            ->update(['confirm_status'=>'Reject', 'date_approve'=> $hari_ini, 'approval'=> Auth::user()->name]);

        Alert::success('Pengajuan Berhasil Di Reject', 'Sukses');
        return back();
    }

    //Absensi
    public function absen()
    {
        return view('manager::absen.index',['aktif_absen'=>'true']);
    }

    public function report_absen(Request $request)
    {
        $request->validate([
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required'
        ]);

        Session::put('tgl_awal', $request->tgl_awal_submit);
        Session::put('tgl_akhir', $request->tgl_akhir_submit);


        $karyawan = DB::table('tbl_employee')
            ->join('tbl_job','tbl_employee.id_job', '=', 'tbl_job.id_job')
            ->join('tbl_division','tbl_division.id_division', '=', 'tbl_employee.id_division')
            ->select('tbl_employee.id_employee', 'tbl_employee.name', 'tbl_employee.gender', 'tbl_job.job', 'tbl_division.division')
            ->where('tbl_employee.id_job','!=','1')
            ->where('tbl_employee.id_job','!=','2')
            ->where('tbl_employee.id_division','=', Auth::user()->id_division)
            ->get();

        if (count($karyawan) > 0) {
            $date_begin = new DateTime($request->tgl_awal_submit, new DateTimeZone("Asia/Jakarta"));
            $date_end = new DateTime($request->tgl_akhir_submit, new DateTimeZone("Asia/Jakarta"));

            $i = 0;
            while ($date_begin <= $date_end) {
                $range_tgl[$i] = $date_begin->format('Y-m-d');
                $only_tgl[$i] = $date_begin->format('d');
                $date_begin->modify("+1 day");
                $i++;
            }

            for ($i=0;$i<count($karyawan);$i++){
                for ($j=0;$j<count($range_tgl);$j++) {
                    $report = DB::table('tbl_absent')
                        ->where('id_employee', $karyawan[$i]->id_employee)
                        ->where('clock_in', 'LIKE', '%' . $range_tgl[$j] . '%')
                        ->first();
                    if (count($report) > 0) {
                        if ($report->absent_status == "Hadir") {
                            $clockin = substr($report->clock_in, '11');
                            if (strtotime($clockin) > strtotime('09:30')) {
                                $absen_report[$i][$j] = "HT";
                            } else {
                                $absen_report[$i][$j] = "H";
                            }
                        } elseif ($report->absent_status == "Sakit") {
                            $absen_report[$i][$j] = "S";
                        } elseif ($report->absent_status == "Izin") {
                            $absen_report[$i][$j] = "I";
                        } elseif ($report->absent_status == "Alpa") {
                            $absen_report[$i][$j] = "A";
                        }
                    }else{
                        if($range_tgl[$j] == date('Y-m-d')) {
                            $absen_report[$i][$j] = "BC";
                        }else{
                            $absen_report[$i][$j] = "-";
                        }
                    }

                }
            }

            //rincian
            $no = 0;
            foreach ($karyawan as $item) {
                $izin[$no] = AbsentManager::where('id_employee', $item->id_employee)
                    ->where('absent_status', 'Izin')
                    ->whereBetween('clock_in', [$request->tgl_awal_submit, $request->tgl_akhir_submit])
                    ->count();
                $sakit[$no] = AbsentManager::where('id_employee', $item
                    ->id_employee)
                    ->where('absent_status', 'Sakit')
                    ->whereBetween('clock_in', [$request->tgl_awal_submit, $request->tgl_akhir_submit])
                    ->count();
                $alpa[$no] = AbsentManager::where('id_employee', $item
                    ->id_employee)
                    ->where('absent_status', 'Alpa')
                    ->whereBetween('clock_in', [$request->tgl_awal_submit, $request->tgl_akhir_submit])
                    ->count();

                $start_date = date('Y-m-d H:i:s', strtotime($request->tgl_awal_submit));
                $end_date = date('Y-m-d H:i:s', strtotime($request->tgl_akhir_submit . ' 23:59:59'));

                $data_telat = DB::table('tbl_absent')
                    ->where('id_employee', $item->id_employee)
                    ->where('absent_status', 'Hadir')
                    ->whereBetween('clock_in', [$start_date, $end_date])
                    ->get()
                    ->toArray();

                $telat[$no] = 0;
                for ($i = 0; $i < count($data_telat); $i++) {
                    $clockin = substr($data_telat[$i]->clock_in, '11');
                    if (strtotime($clockin) > strtotime('09:30')) {
                        $telat[$no] = $telat[$no] + 1;
                    }
                }
                $no++;
            }

            return view('manager::absen.report', ['karyawan'=>$karyawan, 'aktif_absen'=>'true', 'absen_report'=>$absen_report, 'only_tgl'=>$only_tgl, 'izin'=>$izin, 'sakit'=>$sakit, 'alpa'=>@$alpa, 'telat'=>@$telat]);
        }
        else{
            return view('manager::absen.report',['karyawan'=>$karyawan,'aktif_absen'=>'true']);
        }
    }

    public function export()
    {

        $karyawan = DB::table('tbl_employee')
            ->join('tbl_job','tbl_employee.id_job', '=', 'tbl_job.id_job')
            ->join('tbl_division','tbl_division.id_division', '=', 'tbl_employee.id_division')
            ->select('tbl_employee.id_employee', 'tbl_employee.name', 'tbl_employee.gender', 'tbl_job.job', 'tbl_division.division')
            ->where('tbl_employee.id_job','!=','1')
            ->where('tbl_employee.id_job','!=','2')
            ->where('tbl_employee.id_division','=', Auth::user()->id_division)
            ->get();
        $division = DB::table('tbl_division')
            ->where('id_division', '=', Auth::user()->id_division)
            ->first();

        $date_begin = new DateTime(Session::get('tgl_awal'), new DateTimeZone("Asia/Jakarta"));
        $date_end = new DateTime(Session::get('tgl_akhir'), new DateTimeZone("Asia/Jakarta"));

        $i = 0;
        while ($date_begin <= $date_end) {
            $range_tgl[$i] = $date_begin->format('Y-m-d');
            $only_tgl[$i] = $date_begin->format('d');
            $date_begin->modify("+1 day");
            $i++;
        }

        for ($i=0;$i<count($karyawan);$i++){
            for ($j=0;$j<count($range_tgl);$j++) {
                $report = DB::table('tbl_absent')
                    ->where('id_employee', $karyawan[$i]->id_employee)
                    ->where('clock_in', 'LIKE', '%' . $range_tgl[$j] . '%')
                    ->first();
                if (count($report) > 0) {
                    if ($report->absent_status == "Hadir") {
                        $clockin = substr($report->clock_in, '11');
                        if (strtotime($clockin) > strtotime('09:30')) {
                            $absen_report[$i][$j] = "HT";
                        } else {
                            $absen_report[$i][$j] = "H";
                        }
                    } elseif ($report->absent_status == "Sakit") {
                        $absen_report[$i][$j] = "S";
                    } elseif ($report->absent_status == "Izin") {
                        $absen_report[$i][$j] = "I";
                    } elseif ($report->absent_status == "Alpa") {
                        $absen_report[$i][$j] = "A";
                    }
                }else{
                    if($range_tgl[$j] == '2018-08-29') {
                        $absen_report[$i][$j] = "BC";
                    }else{
                        $absen_report[$i][$j] = "-";
                    }
                }

            }
        }

        //rincian
        $no = 0;
        foreach ($karyawan as $item) {
            $izin[$no] = AbsentManager::where('id_employee', $item->id_employee)
                ->where('absent_status', 'Izin')
                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
                ->count();
            $sakit[$no] = AbsentManager::where('id_employee', $item
                ->id_employee)
                ->where('absent_status', 'Sakit')
                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
                ->count();
            $alpa[$no] = AbsentManager::where('id_employee', $item
                ->id_employee)
                ->where('absent_status', 'Alpa')
                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
                ->count();

            $start_date = date('Y-m-d H:i:s', strtotime(Session::get('tgl_awal')));
            $end_date = date('Y-m-d H:i:s', strtotime(Session::get('tgl_akhir') . ' 23:59:59'));

            $data_telat = DB::table('tbl_absent')
                ->where('id_employee', $item->id_employee)
                ->where('absent_status', 'Hadir')
                ->whereBetween('clock_in', [$start_date, $end_date])
                ->get()
                ->toArray();

            $telat[$no] = 0;
            for ($i = 0; $i < count($data_telat); $i++) {
                $clockin = substr($data_telat[$i]->clock_in, '11');
                if (strtotime($clockin) > strtotime('09:30')) {
                    $telat[$no] = $telat[$no] + 1;
                }
            }
            $no++;
        }

//        $no = 0;
//        foreach ($karyawan as $item){
//            $no++;
//            $izin[$no] = AbsentManager::where('id_employee',$item->id_employee)
//                ->where('absent_status','Izin')
//                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
//                ->count();
//            $sakit[$no] = AbsentManager::where('id_employee',$item
//                ->id_employee)
//                ->where('absent_status','Sakit')
//                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
//                ->count();
//            $alpa[$no] = AbsentManager::where('id_employee',$item
//                ->id_employee)
//                ->where('absent_status','Alpa')
//                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
//                ->count();
//
//            $start_date = date('Y-m-d H:i:s', strtotime(Session::get('tgl_awal')));
//            $end_date = date('Y-m-d H:i:s', strtotime(Session::get('tgl_akhir').' 23:59:59'));
//
//            $data_telat = DB::table('tbl_absent')
//                ->where('id_employee', $item->id_employee)
//                ->where('absent_status','Hadir')
//                ->whereBetween('clock_in', [Session::get('tgl_awal'), Session::get('tgl_akhir')])
//                ->get()
//                ->toArray();
//
//            $telat[$no] = 0;
//            for ($i=0;$i<count($data_telat);$i++){
//                $clockin = substr($data_telat[$i]->clock_in,'11');
//                if (strtotime($clockin) > strtotime('09:30')){
//                    $telat[$no] = $telat[$no]+1;
//                }
//            }
//        }

        return view('manager::absen.export', ['karyawan'=>$karyawan, 'absen_report'=>$absen_report, 'only_tgl'=>$only_tgl, 'izin'=>$izin, 'sakit'=>$sakit, 'alpa'=>@$alpa, 'telat'=>@$telat, 'division'=>$division]);
    }
    
    //Profile
    public function profile_detail()
    {
        $id = Auth::user()->id_employee;
        $data = Employee::find($id);
        $job = DB::table('tbl_job')->where('id_job', $data->id_job)->get();
        $division = DB::table('tbl_division')->where('id_division', $data->id_division)->get();

        $gender = $data->gender;

        if ($gender == "P") {
            $female = "checked";
            $male = "";
            $jk = "Female";
        }
        else{
            $male = "checked";
            $female = "";
            $jk = "Male";
        }

        $tgl_lahir = date('d F Y',strtotime($data->birth_date));
        $tgl_lahir_edit = date('d F, Y',strtotime($data->birth_date));
        return view('manager::profile.index',['data'=>$data,'tgl_lahir'=>$tgl_lahir,'jk'=>$jk,'tgl_lahir_edit'=>$tgl_lahir_edit,'male_check'=>$male,'female_check'=>$female, 'job'=>$job, 'division'=>$division]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function profile_update(Request $request)
    {
        $id_employee = Employee::find(Auth::user()->id_employee);

        if ($request->email != $id_employee->email) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg',
                'name'=> 'required',
                'gender' => 'required',
                'birth_place' => 'required',
                'birth_date' => 'required',
                'email' => 'required|email|unique:tbl_employee'
            ]);
        }

        if ($request->hasfile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg',
                'name'=> 'required',
                'gender' => 'required',
                'birth_place' => 'required',
                'birth_date' => 'required',
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

        Alert::success('Data Berhasil Di Update','Success');
        return redirect(route('detail_profile'));
    }

    //Change Password
    public function ubah_password(Request $request)
    {
        $request->validate( [
            'last_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        $data = Employee::all()->where('id_employee', Auth::user()->id_employee);
        if (Hash::check($request->last_password, $data[0]->password)){
            if ($request->new_password == $request->confirm_new_password){
                $id = Employee::find(Auth::user()->id_employee);
                $id->update(['password'=>Hash::make($request->new_password)]);

                Alert::Success('Password Changed Successfully', 'Success');
                return redirect(route('home'));
            }else{
                Alert::error('New Password And Confirm New Password Is Not Same!', 'Error');
                return back();
            }
        }else{
            Alert::error('Last Password Is Wrong!', 'Error');
            return back();
        }

    }
}