<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'email','username', 'password','level','telp','gambar',
    ];

    
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function petugas()
    {
        return $this->belongsToMany('App\User');
    }

    public function getFoto()
    {
        if(!$this->gambar){
            return asset('images/default.png');
        }
        return asset('images/'.$this->gambar);
    }
}
