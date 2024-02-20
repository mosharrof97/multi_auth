<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class StudentController extends Controller
{




public function dashboard(){

    return view('StudentDashboard');
}



public function login(){
    return view('StudentLogin');
}



public function login_submit(Request $request){

$request ->validate([
        'email' =>'required|email',
        'password'=>'required',

]);

$credentials = $request ->only('email','password');

if(Auth::guard('student')->attempt($credentials)){

    $user = Student::where('email',$request->input('email'))->first();
    Auth::guard('student')->login($user);
    return redirect()->route('student_dashboard')->with('success','Login Successful');
}else{
    return redirect()->route('student_login')->with('error','Login unsuccessful');
}


}

public function logout(){

    Auth::guard('student')->logout();
    return redirect()->route('student_login')->with('Success','Logout successfully');
}



public function createStudent(){
    return view('StudentRegister');
}

public function storeStudent(Request $request){

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Student::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $newuser = Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($newuser));

    $user = Student::where('email',$request->input('email'))->first();
    Auth::guard('student')->login($user);
    return redirect()->route('student_dashboard')->with('success','Login Successful');
}
}
