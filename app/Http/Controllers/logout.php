<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class logout extends Controller
{
     public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
     protected function guard()
    {
        return Auth::guard();
    }
}
