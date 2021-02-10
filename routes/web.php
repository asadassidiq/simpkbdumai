<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return view('admin.admin');
});

Route::get('/admin/{any}', function(){
    return view('admin.admin');
})->where('any','.*');

Route::group(['prefix' => 'cetak'], function() {
    //[.. CODE SEBELUMNYA ..]
    Route::get('/{id}/pdf', 'PendaftaranController@generateNK')->name('Soltindo.print');
    Route::get('/{id}/print', 'PendaftaranController@printNK')->name('Soltindo1.print');
    Route::get('/{id}/printmt', 'PendaftaranController@printMT')->name('Soltindo2.print');
    Route::get('/{id}/printstiker', 'PendaftaranController@printstiker')->name('stiker.print');
    Route::get('/{id}/printbukuuji', 'PendaftaranController@printbukuuji')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal1', 'PendaftaranController@printbukuujihal1')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal23', 'PendaftaranController@printbukuujihal23')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal45', 'PendaftaranController@printbukuujihal45')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal6', 'PendaftaranController@printbukuujihal6')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal7', 'PendaftaranController@printbukuujihal7')->name('bukuuji.print');
    Route::get('/{id}/printlmbrpermohonan', 'PendaftaranController@printlembarpermohonan')->name('lmbrpermohonan.print');
    Route::get('/{id}/printlmbrpemeriksaan', 'PendaftaranController@printlembarpemeriksaan')->name('lmbrpemeriksaan.print');
    Route::get('/{id}/printlembarsktl', 'PendaftaranController@printlembarsktl')->name('printlembarsktl.print');
    Route::get('/{id}/printkwitansi', 'TransaksiController@printkwitansi')->name('kwitansi.print');
    Route::get('/{id}/laporanloketpendaftaran', 'LaporanController@printlaporanloketpendaftaran')->name('laporanloketpendaftaran.print');
    Route::get('/{id}/laporanloketpendaftaranbulanan', 'LaporanController@printlaporanloketpendaftaranbulanan')->name('laporanloketpendaftaranbulanan.print');
    Route::get('/{id}/{id2}/laporanloketpendaftarantriwulan', 'LaporanController@printlaporanloketpendaftarantriwulan')->name('laporanloketpendaftaranbulanan.print');
    Route::get('/{id}/laporanloketpendaftarantahunan', 'LaporanController@printlaporanloketpendaftarantahunan')->name('laporanloketpendaftarantahunan.print');
    Route::get('/{id}/laporankeuanganharian', 'LaporanController@printlaporankeuanganharian')->name('laporankeuanganharian.print');
    Route::get('/{id}/laporankeuanganbulanan', 'LaporanController@printlaporankeuanganbulanan')->name('laporankeuanganbulanan.print');
    Route::get('/{id}/laporankeuangantahunan', 'LaporanController@printlaporankeuangantahunan')->name('laporankeuangantahunan.print');
});


Route::get('/uji', function () {
    return view('penguji.penguji');
});

Route::get('/login', function () {
    return view('auth.loginapp');
});

Route::get('/uji/{any}', function(){
    return view('penguji.penguji');
})->where('any','.*');

Route::get('upload/{id}/fotokendaraan/', 'FotoController@getImage')->name('get.image');
Route::POST('intervention_postimage', 'FotoController@postImage')->name('post.image');