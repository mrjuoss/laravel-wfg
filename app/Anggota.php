<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
  //Relasi antara tabel anggota dengan tabel user adalah One to One
  // Satu Anggota Satu User
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
