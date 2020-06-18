<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
	public function login()
	{
		return view('auths.login');
	}
	public function postlogin(Request $request)
	{
		if(Auth::attempt($request->only('email','password'))){
			alert()->success('Berhasil Login.','Selamat Datang !!');
			return redirect('/dashboard'); 
		}else{
			return redirect('/login')->with('flash_message_error','Invalid Userame or Password');
		}


	}
	public function logout()
	{

		Session::flush();
		return redirect('/login')->with('flash_message_success','Logout SuccessFull');
	}
}
