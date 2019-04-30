<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Manager\Entities\Employee;
use Modules\Manager\Entities\TmpTunjangan;
use Modules\Manager\Entities\Tunjangan;
use Session;
use Alert;
use Auth;

class BagitunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
    }

    public function detail(Request $request)
    {
        $request->validate([
           'nama_karyawan' => 'required',
        ]);

        $karyawan = Employee::all()
            ->where('id_job','!=','1')
            ->where('id_job','!=','2')
            ->where('id_division','=', Auth::user()->id_division);
        $nama = Employee::all()->where('name',$request->nama_karyawan)->first();
        $job = DB::table('tbl_job')->where('id_job', $nama->id_job)->first();
        $division = DB::table('tbl_division')->where('id_division', $nama->id_division)->first();
        $tun_yg_dimiliki = DB::table('tbl_tmp_allowance')
            ->join('tbl_employee', 'tbl_tmp_allowance.id_employee','=','tbl_employee.id_employee')
            ->join('tbl_allowance', 'tbl_tmp_allowance.id_allowance','=','tbl_allowance.id_allowance')
            ->select('tbl_tmp_allowance.id_tmp','tbl_allowance.allowance_title','tbl_allowance.allowance_amount')
            ->where('tbl_tmp_allowance.id_employee','=', $nama->id_employee)
            ->get();

        $ambil_id = DB::table('tbl_tmp_allowance')
            ->where('id_employee','=', $nama->id_employee)
            ->get();

        for ($i=0;$i<$ambil_id->count();$i++){
            $id[$i] = $ambil_id[$i]->id_allowance;
        }

        @$data = DB::table('tbl_allowance')
            ->whereNotIn('id_allowance', $id)
            ->get();

        Session::put('id_bagi_tunjangan', $nama->id_employee);

        return view('manager::tunjangan.detail',['nama'=>$nama, 'karyawan'=>$karyawan, 'job'=>$job, 'division'=>$division, 'data'=>$data, 'tun_yg_dimiliki'=>$tun_yg_dimiliki]);
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('manager::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $id_bagi = Session::get('id_bagi_tunjangan');

        for ($i=0;$i<count($request->tunjangan);$i++){
            TmpTunjangan::create([
                'id_employee' => $id_bagi,
                'id_allowance' => $request->tunjangan[$i]
            ]);
        }

        return back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('manager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('manager::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        TmpTunjangan::destroy($id);

        return back();
    }
}
