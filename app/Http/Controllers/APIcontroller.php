<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ServiceTemp;
use App\Kendaraan;
use Response;


class APIcontroller extends Controller
{

  function loginAndroid(Request $request) {
    $logins = DB::table('users')
    ->where('email', $request->email)
    ->where('level', "petugas")
    ->get();

    if (count($logins) > 0) {
     foreach ($logins as $logg) {
      $result["success"] = "1";
      $result["message"] = "success";
    //untuk memanggil data sesi Login
      $result["id"] = $logg->id;
      $result["email"] = $logg->email;
      $result["username"] = $logg->username;
      $result["password"] = $logg->password;
      $result["level"] = $logg->level;
      $result["telp"] = $logg->telp;
      $result["gambar"] = $logg->gambar;
    }
    echo json_encode($result);
  } else {
   $result["success"] = "0";
   $result["message"] = "error";
   echo json_encode($result);
 }
}

function profilAndroid(Request $request) {
  $logins = DB::table('tb_petugas')
  ->where('user_id', $request->user_id)
  ->get();

  if (count($logins) > 0) {
   foreach ($logins as $logg) {
    $result["success"] = "1";
    $result["message"] = "success";
    //untuk memanggil data sesi Login
    $result["id"] = $logg->id;
    $result["email"] = $logg->email;
    $result["nama_petugas"] = $logg->nama_petugas;
    $result["no_hp"] = $logg->no_hp;
    
    $result["alamat"] = $logg->alamat;
    $result["foto"] = $logg->foto;
  }
  echo json_encode($result);
} else {
 $result["success"] = "0";
 $result["message"] = "error";
 echo json_encode($result);
}
}

function kendaraanAndroid(Request $request) {
  $logins = DB::table('tb_kendaraan')
  ->where('id', $request->id)
  ->get();

  if (count($logins) > 0) {
   foreach ($logins as $logg) {
    $result["success"] = "1";
    $result["message"] = "success";
    //untuk memanggil data sesi Login
    $result["id"] = $logg->id;
    $result["petugas_id"] = $logg->petugas_id;
    $result["tempat_tugas"] = $logg->tempat_tugas;
    $result["no_kendaraan"] = $logg->no_kendaraan; 
    $result["no_rangka"] = $logg->no_rangka;
    $result["no_mesin"] = $logg->no_mesin;
    $result["merek"] = $logg->merek;
    $result["jenis"] = $logg->jenis;
    $result["tgl_berlaku"] = $logg->tgl_berlaku;
    $result["tgl_kir"] = $logg->tgl_kir;
    $result["gambar"] = $logg->gambar;
  }
  echo json_encode($result);
} else {
 $result["success"] = "0";
 $result["message"] = "error";
 echo json_encode($result);
}
}

public function insertService(Request $request)
{



 $file = base64_decode($request['foto']);
 $folderName = 'public/imageservice/';
 $safeName = str_random(10).'.'.'png';
 $destinationPath = public_path() . $folderName;
 $success = file_put_contents(public_path().'/imageservice/'.$safeName, $file);
 print $success;
        //insert user
 $serv = new \App\Service;
 
 $serv->kendaraan_id =$request->kendaraan_id;
 $serv->tgl_service =$request->tgl_service;
 $serv->kategori_service =$request->kategori_service;
 $serv->foto_service = $safeName;
 $serv->save();
       /*
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
            $serv->foto_service = $request->file('foto')->getClientOriginalName();
            $serv->save();
          }*/
        }

        public function insertbuktibayar(Request $request)
        {



         $file = base64_decode($request['foto']);
         $folderName = 'public/imagebuktibayar/';
         $safeName = str_random(10).'.'.'png';
         $destinationPath = public_path() . $folderName;
         $success = file_put_contents(public_path().'/imageservice/'.$safeName, $file);
         print $success;
        //insert user
         $serv = new \App\ServiceTemp;
         
         $serv->kendaraan_id =$request->kendaraan_id;
         $serv->tgl_service =$request->tgl_service;
         $serv->kategori_service =$request->kategori_service;
         $serv->foto_service = $safeName;
         $serv->save();
       /*
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
            $serv->foto_service = $request->file('foto')->getClientOriginalName();
            $serv->save();
          }*/
        }

        public function updatestatus(Request $request, $id)
        {
          $status = 2;
          $id = $request->id;
          $data = DB::table('tb_service_temp')->where('id',$id)->update(['status'=>$status]);
          return redirect('service');
          
        }

        public function kirimbukti(Request $request)
        {
          $id =$request->id;
          $file = base64_decode($request['foto']);
          $folderName = 'public/imagebuktibayar/';
          $safeName = str_random(10).'.'.'png';
          $destinationPath = public_path() . $folderName;
          $success = file_put_contents(public_path().'/imagebuktibayar/'.$safeName, $file);

          $data = DB::table('tb_service')->where('id', $id)->update(['bukti_pembayaran'=>$safeName,'status'=>'selesai']);
        }

        function maxbayar(Request $request) {
         $petugas_id = $request->petugas_id;
         $x = DB::table('bayar')
         ->where('petugas_id', $petugas_id)
         ->orderBy('id_service', 'desc')
         ->limit(1)
         ->get();

         if (count($x) == 1) {
           foreach ($x as $logg) {
            $result["success"] = "1";
            $result["message"] = "success";
    //untuk memanggil data sesi Login
            $result["id_service"] = $logg->id_service;
            $result["status"] = $logg->status;
          }
          echo json_encode($result);
        } else {
         $result["success"] = "0";
         $result["message"] = "error";
         echo json_encode($result);
       }
     }


  function pilihkendaraan($id) {
       
         $x = DB::table('tb_kendaraan')
         ->where('petugas_id', $id)
         ->get();

          $response['status'] = 'OK';
          $response['result'] = $x;

          return Response::json($response);
      }

  function riwayatservice($id) {
       
         $x  = Kendaraan::join('tb_petugas','tb_petugas.id','=','tb_kendaraan.petugas_id')
        ->join('tb_service','tb_service.kendaraan_id','=','tb_kendaraan.id')
        ->where('petugas_id',$id)
        ->get();

          $response['status'] = 'OK';
          $response['result'] = $x;

          return Response::json($response);
      }
        /* if (count($x) == 1) {
           foreach ($x as $logg) {
            $result["success"] = "1";
            $result["message"] = "success";
    //untuk memanggil data sesi Login
          $result["id_kendaraan"] = $logg->id;
          $result["petugas_id"] = $logg->petugas_id;
          $result["tempat_tugas"] = $logg->tempat_tugas;
          $result["no_kendaraan"] = $logg->no_kendaraan; 
          $result["no_rangka"] = $logg->no_rangka;
          $result["no_mesin"] = $logg->no_mesin;
          $result["merek"] = $logg->merek;
          $result["jenis"] = $logg->jenis;
          $result["tgl_berlaku"] = $logg->tgl_berlaku;
          $result["tgl_kir"] = $logg->tgl_kir;
          $result["gambar"] = $logg->gambar;
          }
          echo json_encode($result);
        } else {
         $result["success"] = "0";
         $result["message"] = "error";
         echo json_encode($result);
       }*/
     }

     /*function penjadwalansaklar() {
 $jadwal = view_jadwal1::get();

  $response['status'] = 'OK';
  $response['result'] = $jadwal;

  return Response::json($response);
   }*/
