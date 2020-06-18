<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index(Request $request)

    {       
        if(Auth::user()->level == 'kadin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/dashboard');
        }
        if($request->has('cari')){
            $data_user = User::where('username','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_user = User::all();  
        }
        return view('user.index',['data_user' => $data_user]);
    }

    public function create()
    {   
        return view('user.register');
    }

    public function edit($id)
    {
    	$user = \App\User::find($id);
    	return view('user/edit',['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $user_data = User::findOrFail($id);

        if($request->file('gambar')) 
        {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('gambar')->move("images/user", $fileName);
            $user_data->gambar = $fileName;
            
        }

        $user_data->username = $request->input('username');
        $user_data->email = $request->input('email');
        if($request->input('password')) {
            $user_data->level = $request->input('level');
            $user_data->telp = $request->input('telp');
        }

        if($request->input('password')) {
            $user_data->password= bcrypt(($request->input('password')));
            
        }

        $user_data->update();

        Session::flash('message', 'Berhasil diubah!');
        Session::flash('message_type', 'success');
        return redirect()->to('user');
    }

    public function delete($id)
    {
        $data_user = \App\User::find($id);
        $data_user->delete();
        alert()->success('Berhasil.','Data Berhasil Dihapus!');
        return redirect('/user');
    }
    public function store(Request $request)
    {
        $count = User::where('username',$request->input('username'))->count();

        if($count>0){
            Session::flash('message', 'Already exist!');
            Session::flash('message_type', 'danger');
            return redirect()->to('user');
        }

        $this->validate($request, [
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);


        if($request->file('gambar') == '') {
            $gambar = NULL;
        } else {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('gambar')->move("images/user", $fileName);
            $gambar = $fileName;
        }

        User::create([
            'telp'=>$request->input('telp'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'level' => $request->input('level'),
            'password' => bcrypt(($request->input('password'))),
            'gambar' => $gambar
        ]);
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('user.index');

    }


}