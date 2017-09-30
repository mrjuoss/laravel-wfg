<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert-anggota', function(){
  $user = new \App\User;

  $user->email = "subangkit@ymail.com";
  $user->name = "Subangkit";
  $user->password = bcrypt('subangkit');
  $user->save();

  $anggota = new \App\Anggota;

  $anggota->nama = "Subangkit";
  $anggota->alamat = "Surabaya";

  $user->anggota()->save($anggota);

  // Setelah dijakankan akan tersimpan dalam tabel User dan Anggota
});

Route::get('/select-anggota', function(){
  $data = \App\User::with('anggota')->get();
  echo "<table border='2'>";
  foreach ($data as $key => $value) {
    echo "<tr>
      <td>".$value->name."</td>
      <td>".$value->email."</td>
      <td>".$value->password."</td>
      <td>".$value->anggota->nama."</td>
      <td>".$value->anggota->alamat."</td>
    </tr>";
  }
  echo "</table>";
});

Route::get('update-anggota', function(){
  $user = \App\User::find(1);
  $user->name = "mrjuoss";
  $user->save();

  $user->anggota->nama= "Mujaki";
  $user->anggota->save();
});

Route::get('/sukamakmur', function(){
  // Versi 1
  // $desa = \App\Desa::where('nama', 'like', '%sukamakmur')->with('kecamatan')->get();

  // VERSI 2 lebih cepat dari versi 1
  // $desa = \App\Desa::where('nama', 'like', '%sukamakmur')->with('kecamatan')->get();

  // Klo with lebih dari 1 maka akan Error
  // $desa = \App\Desa::where('nama', 'like', '%sukamakmur%')->with('kecamatan', 'kabupaten', 'provinsi')->get();

  // Biar ndak Error maka solusinya adalah
  // Kita tidak bisa menggunakan kode diatas karena Desa tidak memiliki relasi langsung dengan Kabupaten ataupun Provinsi. Yang bisa kita lakukan adalah melakukan nested with:

  // Versi 3 yang paling baik [ NESTED WITH ]
  $desa = \App\Desa::where('nama', 'like', '%sukamakmur%')
    ->with([
        'kecamatan' => function($query) {
            return $query->with([
                'kabupaten' => function($query) {
                    return $query->with('provinsi');
            }]);
        }])
    ->get();

  return view('index', compact('desa'));
});
