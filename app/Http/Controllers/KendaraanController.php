<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan;
use App\Petugas;
use App\Service;
use Auth;
use Session;
use App\Exports\KendaraanExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Carbon\Carbon;


class KendaraanController extends Controller
{
  public function index(Request $request)
  {
   $data_kendaraan = Kendaraan::paginate(5);
   return view('kendaraan.index',['data_kendaraan' => $data_kendaraan]);
 }



 public function create()
 {
  return view('kendaraan.create');
}

public function edit($id)
{
  $query = \App\Petugas::all();  
  $data_kendaraan = \App\Kendaraan::find($id);
  return view('kendaraan/edit',['kendaraan'=>$data_kendaraan],compact('data_kendaraan', 'query'));

}

public function update(Request $request, $id)
{
  $this->validate($request, [
    'petugas_id' => 'required|string|max:100',
    'tempat_tugas' => 'required|string|',
  ]);

  $data_kendaraan = Kendaraan::findOrFail($id);
  if($request->file('gambar')) 
  {
    $file = $request->file('gambar');
    $dt = Carbon::now();
    $acak  = $file->getClientOriginalExtension();
    $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
    $request->file('gambar')->move("images/user", $fileName);
    $data_kendaraan->gambar = $fileName; 
  }

  $data_kendaraan->petugas_id = $request->input('petugas_id');
  $data_kendaraan->tempat_tugas = $request->input('tempat_tugas');
  $data_kendaraan->no_kendaraan = $request->input('no_kendaraan');
  $data_kendaraan->no_rangka = $request->input('no_rangka');
  $data_kendaraan->no_mesin = $request->input('no_mesin');
  $data_kendaraan->merek = $request->input('merek');
  $data_kendaraan->jenis = $request->input('jenis');
  $data_kendaraan->tgl_berlaku = $request->input('tgl_berlaku');
  $data_kendaraan->tgl_kir = $request->input('tgl_kir');
  $data_kendaraan->tahun_masuk = $request->input('tahun_masuk');

  $data_kendaraan->update();

  alert()->success('Berhasil.','Data Berhasil Dirubah!');
  return redirect()->to('kendaraan');
} 
public function profile($id)
{

  $kendaraan = \App\Kendaraan::find($id);
  return view('kendaraan.profile',['kendaraan' =>$kendaraan]);
}

public function bayar_pajak(Request $request, $id)
{
  $data_kendaraan = Kendaraan::findOrFail($id);
  $data = $data_kendaraan->tgl_berlaku;
  $tanggal = date('Y-m-d',strtotime('+5 year',strtotime($data)));
  $data_kendaraan->tgl_berlaku = $tanggal;
  $data_kendaraan->update();
  alert()->success('Berhasil.','Kendaraan telah dibayar');
  return redirect()->to('dashboard');
}

public function bayar_kir(Request $request, $id)
{
  $data_kendaraan = Kendaraan::findOrFail($id);
  $data = $data_kendaraan->tgl_kir;
  $tanggal = date('Y-m-d',strtotime('+5 year',strtotime($data)));
  $data_kendaraan->tgl_kir = $tanggal;
  $data_kendaraan->update();
  alert()->success('Berhasil.','Kendaraan telah dibayar');
  return redirect()->to('dashboard');
}

public function delete($id)
{
  $data_kendaraan = \App\Kendaraan::find($id);
  $data_kendaraan->delete();
  alert()->success('Berhasil.','Data Berhasil Dihapus!');
  return redirect('/kendaraan');
}

public function store(Request $request)
{

  $this->validate($request, [
    'petugas_id' => 'required|string|max:100',
    'tempat_tugas' => 'required|string|',
    'no_kendaraan' => 'required|unique:tb_kendaraan|',
    'no_mesin|unique:tb_kendaraan|',
    'no_rangka|unique:tb_kendaraan|',

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

  Kendaraan::create([
    'stnk_id' => $request->input('stnk_id'),
    'petugas_id' => $request->input('petugas_id'),
    'tempat_tugas'=>$request->input('tempat_tugas'),
    'no_kendaraan' => $request->input('no_kendaraan'),
    'no_mesin' => $request->input('no_mesin'),
    'no_rangka'=>$request->input('no_rangka'),
    'merek' => $request->input('merek'),
    'jenis' => $request->input('jenis'),
    'tgl_berlaku' =>$request->input('tgl_berlaku'),
    'tgl_kir' =>$request->input('tgl_kir'),
    'tahun_masuk' =>$request->input('tahun_masuk'),
    'gambar' => $gambar

  ]);
  alert()->success('Berhasil.','Kendaraan telah Ditambahkan');
  return redirect()->route('kendaraan.index');

}

public function exportExcel() 
{
  return Excel::download(new KendaraanExport, 'Kendaraan.xlsx');
}

public function exportPdf(Request $request)
{
 
  $jenis = Request('jenis');
  if ($request->get('rekap-data'))
  {
    $kendaraan= Kendaraan::where('jenis', [$jenis])->get();
  }else {
    $kendaraan= Kendaraan::all();
  }

  $pdf = PDF::loadView('export.kendaraanpdf',compact('kendaraan'));
  return $pdf->download('laporan data kendaraan.pdf');
}

public function show($id)
{
  $data_kendaraan = Kendaraan::findOrFail($id);

  return view('kendaraan.show', compact('kendaraan'));

}

}
