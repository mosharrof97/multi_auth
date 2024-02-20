<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Str;
class AdminController extends Controller
{




public function dashboard(){

    return view('AdminDashboard');
}



public function login(){
    return view('AdminLogin');
}



public function login_submit(Request $request){

$request ->validate([
        'email' =>'required|email',
        'password'=>'required',

]);

$credentials = $request ->only('email','password');

if(Auth::guard('admin')->attempt($credentials)){

    $user = Admin::where('email',$request->input('email'))->first();
    Auth::guard('admin')->login($user);
    return redirect()->route('admin_dashboard')->with('success','Login Successful');
}else{
    return redirect()->route('admin_login')->with('error','Login unsuccessful');
}


}

public function logout(){

    Auth::guard('admin')->logout();
    return redirect()->route('admin_login')->with('Success','Logout successfully');
}




}
