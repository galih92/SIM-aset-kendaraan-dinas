<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'tb_petugas';
    protected $fillable = ['nama_petugas','alamat','no_hp','email','user_id','foto'];

    public function getFoto()
    {
        if(!$this->foto){
            return asset('images/default.png');
        }
        return asset('images/'.$this->foto);
    }

    public function kendaraan()
    {
    	return $this->hasOne(Kendaraan::class,'kendaraan_id');
    }

    public function service()
    {
    	return $this->hasMany(Service::class);
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
