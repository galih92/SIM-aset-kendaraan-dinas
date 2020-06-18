<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller{


    public function index(Request $request)
    {       
        if(Auth::user()->level == 'kadin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/dashboard');
        }
        
        $data_petugas = \App\Petugas::all(); 
        return view('petugas.index',['data_petugas'=>$data_petugas]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_petugas' => 'required|string|min:5',
            'alamat' => 'required|string|min:5',
            'no_hp' => 'required|string|min:10|max:15',
            
        ]);
        //insert user
        $user = new \App\User;
        $user->level ='petugas';
        $user->username =$request->nama_petugas;
        $user->email =$request->email;
        $user->password =bcrypt('rahasia');
        $user->telp =$request->no_hp;
        $user->gambar = "{{url('images/kendaraan/default.png')}}";
        $user->save();
        //insert petugas
        $request->request->add(['user_id'=>$user->id]);
        $petugas = \App\Petugas::create($request->all());

        alert()->success('message', 'Berhasil ditambahkan!');
        return redirect('/petugas');
    }
    public function Edit($id)
    {
        $petugas = \App\Petugas::find($id);

        return view('petugas/edit',['petugas'=>$petugas]);
    }
    public function Update(Request $request,$id)
    {
      $this->validate($request, [
        'nama_petugas' => 'required|string|min:5',
        'alamat' => 'required|string|min:5',
        'no_hp' => 'required|string|min:11|max:12',
    ]);
        //dd($request->all());
      $petugas = \App\Petugas::find($id);
      $petugas->update($request->all());
      if($request->hasFile('foto')){
        $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
        $petugas->foto = $request->file('foto')->getClientOriginalName();
        $petugas->save();
    }
    alert()->success('Berhasil.','Kendaraan telah dganti');
    return redirect('/petugas');
}
public function delete($id)
{
    $petugas = \App\Petugas::find($id);
    $petugas->delete($petugas);
    alert()->success('message', 'Berhasil Dihapus!');
    return redirect('/petugas');
}

public function email($id)
{
    $petugas = \App\Petugas::find($id);
    return view('email/email_form',['petugas'=>$petugas]);
}
}
