<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Editor;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;


class EditorController extends Controller
{




public function dashboard(){

    return view('EditorDashboard');
}



public function login(){
    return view('EditorLogin');
}



public function login_submit(Request $request){

$request ->validate([
        'email' =>'required|email',
        'password'=>'required',

]);

$credentials = $request ->only('email','password');

if(Auth::guard('editor')->attempt($credentials)){

    $user = Editor::where('email',$request->input('email'))->first();
    Auth::guard('editor')->login($user);
    return redirect()->route('editor_dashboard')->with('success','Login Successful');
}else{
    return redirect()->route('editor_login')->with('error','Login unsuccessful');
}


}

public function logout(){

    Auth::guard('editor')->logout();
    return redirect()->route('editor_login')->with('Success','Logout successfully');
}





public function createEditor(Request $request){
    return view('EditorRegister');
}

public function storeEditor(Request $request){

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Editor::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $newuser = Editor::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($newuser));

    $user = Editor::where('email',$request->input('email'))->first();
    Auth::guard('editor')->login($user);
    return redirect()->route('editor_dashboard')->with('success','Login Successful');

}
}
