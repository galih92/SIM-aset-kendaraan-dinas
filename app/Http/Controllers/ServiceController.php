<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Auth;
use Session;
use Carbon\Carbon;
use App\Kendaraan;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\ServiceExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ServiceController extends Controller{


    public function index(Request $request)
    {$mytime = Carbon::now();
        if ($data_service= Service::select('status','=','pengajuan')
            ->where('tgl_service','<=',[$mytime])) {
            $data_service->delete();
        }
        $data_service_pengajuan = Kendaraan::join('tb_petugas','tb_petugas.id','=','tb_kendaraan.petugas_id')
        ->join('tb_service','tb_service.kendaraan_id','=','tb_kendaraan.id')
        ->where('status','pengajuan')
        ->paginate(5);
        $data_service_diterima  = Kendaraan::join('tb_petugas','tb_petugas.id','=','tb_kendaraan.petugas_id')
        ->join('tb_service','tb_service.kendaraan_id','=','tb_kendaraan.id')
        ->where('status','selesai')
        ->paginate(5);
        $mytime = Carbon::now();
        return view('service.index',compact('data_service_pengajuan','data_service_diterima','mytime')); 
    }

    public function create()
    {
        return view('service.create');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service/edit',['service'=>$service]);
    }

    public function update(Request $request, $id)
    {
        $data_service = Service::findOrFail($id);
        $data_service->kendaraan_id = $request->input('kendaraan_id');
        $data_service->tgl_service = $request->input('tgl_service');
        $data_service->tgl_part = $request->input('tgl_part');
        $data_service->tgl_oli = $request->input('tgl_oli');
        $data_service->update();

        alert()->success('Berhasil.','Data Berhasil Ganti!');
        return redirect()->to('service');
    }

    public function update2(Request $request, $id)
    {
        $data_service = Service::findOrFail($id);
        $data = $data_service->tgl_service;
        $tanggal = date('Y-m-d',strtotime('+4 month',strtotime($data)));
        $data_service->tgl_service = $tanggal;

        $data_service->update();


        alert()->success('Berhasil.','Kendaraan telah dibayar');
        return redirect()->to('service');
    }

    public function terima(Request $request, $id)
    {
        $data_service = Service::findOrFail($id);

        $data_service->update([
            'status' => 'diterima',
        ]);


        alert()->success('Berhasil.','Kendaraan akan diservice');
        return redirect()->to('service');
    }
    public function selesai(Request $request, $id)
    {
        $data_service = Service::findOrFail($id);

        $data_service->update([
            'status' => 'selesai',
            'jumlah_service'=> ($data_service->jumlah_service +1),
        ]);


        alert()->success('Berhasil.','Kendaraan selesai di service');
        return redirect()->to('service');
    }

    public function delete($id)
    {
        $data_service = \App\Service::find($id);
        $data_service->delete();
        alert()->success('Berhasil.','Data Berhasil Dihapus!');
        return redirect('/service');
    }

    public function show($id)
    {
        $data_service = Service::findOrFail($id);

        return view('service.show', compact('service'));
    }

    public function store(Request $request)
    {

        if($request->file('bukti_pembayaran') == '') {
            $bukti_pembayaran = NULL;
        } else {
            $file = $request->file('bukti_pembayaran');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('bukti_pembayaran')->move("images/user", $fileName);
            $bukti_pembayaran = $fileName;
        }

        Service::create([
            'kendaraan_id' => $request->input('kendaraan_id'),
            'tgl_service' => $request->input('tgl_service'),
            'kategori_service' => $request->input('kategori_service'),
            'status' => 'pengajuan',
            'bukti_pembayaran' => $bukti_pembayaran

        ]);
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('service.index');

    }

    public function exportExcel() 
    {
        return Excel::download(new ServiceExport, 'Service.xlsx');
    }

    public function exportPdf(Request $request)
    {

        $status = Request('status');
        if ($request->get('rekap-data'))
        {
            $service= Kendaraan::join('tb_service','tb_service.kendaraan_id','=','tb_kendaraan.id')
            ->join('tb_petugas','tb_petugas.id','=','tb_kendaraan.petugas_id')
            ->where('status',[$status])->get();
        }else{
            $service = Service::all();    
        }

        $pdf = PDF::loadView('export.servicepdf',compact('service'));
        return $pdf->download('service.pdf');
    }

}
