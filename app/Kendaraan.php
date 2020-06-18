<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'tb_kendaraan';
    protected $fillable = ['petugas_id','tahun_masuk','tempat_tugas','gambar','no_kendaraan','no_rangka','no_mesin','merek','jenis','tgl_berlaku','tgl_kir'];

    public function service()
    {
    	return $this->hasMany(Service::class);
    }

    public function petugas()
    {
    	return $this->belongsTo(Petugas::class);
    }
    
    
}
