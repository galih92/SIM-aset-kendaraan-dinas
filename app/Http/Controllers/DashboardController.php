<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan;
use App\Petugas;
use App\Service;
use App\User;
use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller
{


	public function index(Request $request)
	{
		if(Auth::user()->level == 'petugas') {
			Alert::info('Oopss..', 'Petugas Menggunakan Perangkar Mobile.');
			return redirect()->to('/login');
		}else{
			$data_kendaraan = \App\Kendaraan::all(); 
			$data_petugas = \App\Petugas::all();
			$data_service = \App\Service::all();
			$mytime = Carbon::now();
			$now = date('D-m-Y');

		}
		
		return view('dashboards.index',['data_kendaraan' => $data_kendaraan],compact('data_kendaraan', 'data_petugas', 'data_service','mytime','now'));
	}


}

