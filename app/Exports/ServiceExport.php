<?php

namespace App\Exports;
use App\Kendaraan;
use App\Petugas;
use App\Stnk;
use App\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ServiceExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return  $service = Kendaraan::join('tb_petugas','tb_petugas.id','=','tb_kendaraan.petugas_id')
      ->join('tb_service','tb_service.kendaraan_id','=','tb_kendaraan.id')
      ->get();
    }

    public function map($service): array
    {	  

      return [

        $service->no++,
        $service->no_kendaraan,
        $service->nama_petugas,
        $service->merek,
        $service->jenis,
        $service->tgl_service,
        $service->status,
      ];

    }
    public function headings(): array
    {
      return [
       
        '#',
        'No Kendaraan',
        'Nama Petugas',
        'Merek',
        'Jenis',
        'Tgl service',
        'status',
      ];
    }
  }
