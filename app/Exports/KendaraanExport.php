<?php

namespace App\Exports;

use App\Kendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class KendaraanExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return Kendaraan::all();
    }

    public function map($kendaraan): array
    {	
      return [
        $kendaraan->no++,
        $kendaraan->no_kendaraan,
        $kendaraan->petugas->nama_petugas,
        $kendaraan->merek,
        $kendaraan->jenis,
        $kendaraan->tgl_berlaku,
        $kendaraan->stgl_kir

      ];
    }
    public function headings(): array
    {
      return [
        'No',
        'No Kendaraan',
        'Nama Petugas',
        'Merek',
        'Jenis',
        'Tgl Berlaku',
        'Tgl KIR'
      ];
    }
  }
