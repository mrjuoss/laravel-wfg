<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function anggota()
    {
      //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
      return $this->hasOne('App\Anggota', 'id_user', 'id');
      //Kelas Model User mempunya 1 Anggota dengan Foreign Key bernama id_user pada tabel anggota dan merujuk pada kolom id pada tabel User
    }
}
