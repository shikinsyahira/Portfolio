<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
public function index(){
    return view('login.index');
}
public function auth(Request $request){
    $credentials=$request->validate([
        'username' => 'required',
        'password'=>'required',
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('admin');
    }
    return back()->with('failed','Login failed!!');
}
public function logout(Request $request){
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
return redirect('/');
}
}