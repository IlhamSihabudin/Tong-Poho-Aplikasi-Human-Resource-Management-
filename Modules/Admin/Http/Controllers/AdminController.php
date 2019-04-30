<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Pegawai;
use Modules\Admin\Entities\Job;
use Modules\Admin\Entities\Division;
use Alert;
use DB;
use auth;
use File;

class AdminController extends Controller
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
        DB::table('tbl_employee')->count();
        $admin = Pegawai::all();
        $job = Job::all();
        $division = Division::all();
        $countp = Pegawai::count();
        $countj = Job::count();
        $countd = Division::count();
        return View('admin::index',['admin'=>$admin,'job'=>$job,'divisi'=>$division,'countp'=>$countp,'countj'=>$countj,'countd'=>$countd]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    // Controller Division
    public function createdivisi()
    {
        return view('admin::inputdivisi');
    }

    public function inputdivisi(Request $request)
    {
        $request->validate([
            'division'=> 'required|string'
        ]);

        Division::create([
            'division' => $request->division,
        ]);
        Alert::success('Data Has Been Save!','Success');
        return redirect(route('admin_showdivisi'));
    }

    public function showdivisi()
    {
        $admin = Division::all();

        return view('admin::showdivisi',['admin'=>$admin]);
    }

    public function deletedivisi($id)
    {
        $divisi = Division::find($id);
        $divisi ->delete();
        Alert::success('Data Has Been Deleted!','Deleted');
        return back(); 
    }

    public function editdivisi($id)
    {   
        $edit = Division::find($id);

        return view('admin::editdivisi',['edit'=>$edit]);
    }

    public function updatedivisi(Request $request, $id)
    {
        $divisi = Division::find($id);
        $request->validate([
            'division'=> 'required|string'
        ]);

        $update = [
            'division' => $request->division
        ];

        $divisi->update($update);
        Alert::success('Data Has Been Update!','Success');
        return redirect('/admin/showdivisi');
    }

    // Controller Job
    public function createjob()
    {
        return view('admin::inputjob');
    }

    public function inputjob(Request $request)
    {
        $request->validate([
            'job'=> 'required|string',
            'salary'=> 'required'
        ]);

        Job::create([
            'job' => $request->job,
            'salary' => $request->salary
        ]);
        Alert::success('Data Has Been Save!','Success');
        return redirect(route('admin_showjob'));
    }

    public function deletejob($id)
    {
        $job = Job::find($id);
        $job ->delete();
        Alert::success('Data Has Been Deleted!','Deleted');
        return back();
    }

    public function showjob()
    {
        $admin = Job::all();

        return view('admin::showjob',['admin'=>$admin]);
    }

     public function editjob($id)
    {   
        $edit = Job::find($id);

        return view('admin::editjob',['edit'=>$edit]);
    }

    public function updatejob(Request $request, $id)
    {
        $job = Job::find($id);
        $request->validate([
            'job'=> 'required|string',
            'salary'=> 'required'
        ]);

        $update = [
            'job' => $request->job,
            'salary' => $request->salary
        ];

        $job->update($update);
        Alert::success('Data Has Been Updated!','Success');
        return redirect('/admin/showjob');
    }


    // Controller Employee
    public function create()
    {
        $job = Job::all();
        $divisi = Division::all();
        return view('admin::inputdp',['job'=>$job],['divisi'=>$divisi]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function store(Request $request)
    {
        // Mengubah Format Tanggal
        $tggl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        $tggl_awal = date('Y-m-d', strtotime($request->tgl_awal));
        $tggl_akhir = date('Y-m-d', strtotime($request->tgl_akhir));
        
        if ($request->hasfile('photo')) {
        $request->validate([
            'nama'=> 'required|string',
            'jk'=> 'required',
            'tempat'=> 'required',
            'tgl_lahir'=> 'required',
            'email'=> 'required|unique:tbl_employee|email',
            'photo'=> 'required|image|mimes:jpg,png,jpeg',
            'job'=> 'required',
            'divisi'=> 'required',
            'tgl_awal'=> 'required',
            'tgl_akhir'=> 'required',
            'pass'=> 'required|string|min:6',
        ]);
        // Validasi File(Photo)
        $img = $request->file('photo');
        $name_img = date('Y-m-d').'-'.rand().'.'.$img->getClientOriginalExtension();
        $path = public_path('/upload');
        $img->move($path,$name_img);
        Pegawai::create([
            'name' => $request->nama,
            'gender' => $request->jk,
            'birth_place' => $request->tempat,
            'birth_date' => $tggl_lahir,
            'email' => $request->email,
            'photo' => $name_img,
            'id_job' => $request->job,
            'id_division' => $request->divisi,
            'contract_begin' => $tggl_awal,
            'contract_end' => $tggl_akhir,
            'password' => Hash::make($request['pass']),
            'number_of_leave' => $request->jml_cuti
        ]);
        } 
        Alert::success('Data Has Been Save!','Success');
        return redirect(route('admin_showdp'));

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        $admin = Pegawai::all()->where('id_job', '!=','1');
        $job = Job::all();
        $division = Division::all();
        return view('admin::tampildp',['admin'=>$admin,'job'=>$job,'divisi'=>$division]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {   
        $edit = Pegawai::find($id);
        $job = Job::all();
        $division = Division::all();
        return view('admin::editdp',['edit'=>$edit,'job'=>$job,'divisi'=>$division]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $id_employee = Pegawai::find($id);
        $last_email = $id_employee->email;
        if ($request->email == $last_email) {
            if ($request->pass != "") {
                $request->validate([
                    'nama'=> 'required|string',
                    'jk'=> 'required',
                    'tempat'=> 'required',
                    'tgl_lahir_submit'=> 'required',
                    'email'=> 'required|email',
                    'job'=> 'required',
                    'divisi'=> 'required',
                    'tgl_awal_submit'=> 'required',
                    'tgl_akhir_submit'=> 'required',
                    'pass' => 'required',
                    'jml_cuti' => 'required'
                ]);

                $update = [
                    'name' => $request->nama,
                    'gender' => $request->jk,
                    'birth_place' => $request->tempat,
                    'birth_date' => $request->tgl_lahir_submit,
                    'email' => $request->email,
                    'id_job' => $request->job,
                    'id_division' => $request->divisi,
                    'contract_begin' => $request->tgl_awal_submit,
                    'contract_end' => $request->tgl_akhir_submit,
                    'password' => Hash::make($request->pass),
                    'number_of_leave' => $request->jml_cuti
                ];
            }
            else{
                if ($request->email == $last_email) {
                    $request->validate([
                    'nama'=> 'required|string',
                    'jk'=> 'required',
                    'tempat'=> 'required',
                    'tgl_lahir_submit'=> 'required',
                    'email'=> 'required|email',
                    'job'=> 'required',
                    'divisi'=> 'required',
                    'tgl_awal_submit'=> 'required',
                    'tgl_akhir_submit'=> 'required',
                    'jml_cuti' => 'required'
                    ]);
                }
                $update = [
                    'name' => $request->nama,
                    'gender' => $request->jk,
                    'birth_place' => $request->tempat,
                    'birth_date' => $request->tgl_lahir_submit,
                    'email' => $request->email,
                    'id_job' => $request->job,
                    'id_division' => $request->divisi,
                    'contract_begin' => $request->tgl_awal_submit,
                    'contract_end' => $request->tgl_akhir_submit,
                    'number_of_leave' => $request->jml_cuti
                ];
            }
        }
         else{
            if ($request->pass != "") {
                $request->validate([
                    'nama'=> 'required|string',
                    'jk'=> 'required',
                    'tempat'=> 'required',
                    'tgl_lahir_submit'=> 'required',
                    'email'=> 'required|email|unique:tbl_employee',
                    'job'=> 'required',
                    'divisi'=> 'required',
                    'tgl_awal_submit'=> 'required',
                    'tgl_akhir_submit'=> 'required',
                    'pass' => 'required',
                    'jml_cuti' => 'required'
                ]);

                $update = [
                    'name' => $request->nama,
                    'gender' => $request->jk,
                    'birth_place' => $request->tempat,
                    'birth_date' => $request->tgl_lahir_submit,
                    'email' => $request->email,
                    'id_job' => $request->job,
                    'id_division' => $request->divisi,
                    'contract_begin' => $request->tgl_awal_submit,
                    'contract_end' => $request->tgl_akhir_submit,
                    'password' => Hash::make($request->pass),
                    'number_of_leave' => $request->jml_cuti
                ];
            }
            else{
                if ($request->email == $last_email) {
                    $request->validate([
                    'nama'=> 'required|string',
                    'jk'=> 'required',
                    'tempat'=> 'required',
                    'tgl_lahir_submit'=> 'required',
                    'email'=> 'required|email|unique:tbl_employee',
                    'job'=> 'required',
                    'divisi'=> 'required',
                    'tgl_awal_submit'=> 'required',
                    'tgl_akhir_submit'=> 'required',
                    'jml_cuti' => 'required'
                    ]);
                }
                $update = [
                    'name' => $request->nama,
                    'gender' => $request->jk,
                    'birth_place' => $request->tempat,
                    'birth_date' => $request->tgl_lahir_submit,
                    'email' => $request->email,
                    'id_job' => $request->job,
                    'id_division' => $request->divisi,
                    'contract_begin' => $request->tgl_awal_submit,
                    'contract_end' => $request->tgl_akhir_submit,
                    'number_of_leave' => $request->jml_cuti
                ];
            }
        }    

        $id_employee->update($update);
        Alert::success('Data Has Been Updated','Success');
        return redirect('/admin/showdp');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai ->delete();
        Alert::success('Data Has Been Deleted','Deleted');
        return back(); 
    }
    public function showcon()
     {
         $admin = Pegawai::all();
         $job = Job::all();
         $divisi = Division::all();
         return view('admin::showcon',['admin'=>$admin,'job'=>$job,'divisi'=>$divisi]);
     }

     public function editcon($id)
     {   
         $edit = Pegawai::find($id);
         $job = Job::all();
         $divisi = Division::all();
         return view('admin::tambahcon',['edit'=>$edit,'job'=>$job,'divisi'=>$divisi]);
     }

     public function updatecon(Request $request, $id)
    {
        $id_employee = Pegawai::find($id);
        $request->validate([
            'tgl_awal_submit'=> 'required',
            'tgl_akhir_submit'=> 'required'
        ]);

        $update = [
            'contract_begin' => $request->tgl_awal_submit,
            'contract_end' => $request->tgl_akhir_submit
        ];

        $id_employee->update($update);
        Alert::success('Data Has Been Updated','Success');
        return redirect('/admin/showcon');
    }
     public function detail_profile()
    {
        $id = Auth::user()->id_employee;
        $data = Pegawai::find($id);

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
        return view('admin::detail_profil',['data'=>$data,'tgl_lahir'=>$tgl_lahir,'male_check'=>$male,'female_check'=>$female,'job'=>$job,'division'=>$division]);
    }
    
     public function update_profile(Request $request)
    {
       $id_employee = Pegawai::find(Auth::user()->id_employee);

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
       Alert::success('Data Berhasil Di Hapus','Success');
       return back();
    }
     public function update_password(Request $request)
    {
      $id_employee = Pegawai::find(Auth::user()->id_employee);

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
}