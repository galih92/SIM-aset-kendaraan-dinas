<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'tb_service';
    protected $fillable = ['kendaraan_id','tgl_service','kategori_service','foto_service','bukti_pembayaran','status','jumlah_service'];


    public function kendaraan ()
    {
    	return $this->belongsToMany(Kendaraan::class);
    }

    public function stnk ()
    {
    	return $this->belongsTo(Stnk::class);
    }
    public function petugas ()
    {
    	return $this->belongsTo(Petugas::class);
    }
}
