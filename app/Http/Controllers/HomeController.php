<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function redirect()
    {
        return view('loader');
        if (Auth::user()->id_job == "1") {
            return redirect('/admin');
        }
        elseif(Auth::user()->id_job == "2"){
            return redirect('/manager');
        }
        else{
            return redirect('/karyawan');
        }
    }
}
