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
    Route::get('/{id}/pdf', 'PendaftaranController@generateNK')->name('invoice.print');
    Route::get('/{id}/print', 'PendaftaranController@printNK')->name('invoice1.print');
    Route::get('/{id}/printmt', 'PendaftaranController@printMT')->name('invoice2.print');
    Route::get('/{id}/printstiker', 'PendaftaranController@printstiker')->name('stiker.print');
    Route::get('/{id}/printbukuuji', 'PendaftaranController@printbukuuji')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal1', 'PendaftaranController@printbukuujihal1')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal23', 'PendaftaranController@printbukuujihal23')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal45', 'PendaftaranController@printbukuujihal45')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal6', 'PendaftaranController@printbukuujihal7')->name('bukuuji.print');
    Route::get('/{id}/printbukuujihal7', 'PendaftaranController@printbukuujihal7')->name('bukuuji.print');
    Route::get('/{id}/printlmbrpermohonan', 'PendaftaranController@printlembarpermohonan')->name('lmbrpermohonan.print');
    Route::get('/{id}/printlmbrpemeriksaan', 'PendaftaranController@printlembarpemeriksaan')->name('lmbrpemeriksaan.print');
    Route::get('/{id}/printlembarsktl', 'PendaftaranController@printlembarsktl')->name('printlembarsktl.print');
    Route::get('/{id}/printkwitansi', 'TransaksiController@printkwitansi')->name('kwitansi.print');
    Route::get('/{id}/laporanloketpendaftaran', 'PendaftaranController@printlaporanloketpendaftaran')->name('laporanloketpendaftaran.print');
    Route::get('/{id}/laporanloketpendaftaranbulanan', 'PendaftaranController@printlaporanloketpendaftaranbulanan')->name('laporanloketpendaftaranbulanan.print');
    Route::get('/{id}/laporanloketpendaftarantahunan', 'PendaftaranController@printlaporanloketpendaftarantahunan')->name('laporanloketpendaftarantahunan.print');
    Route::get('/{id}/laporankeuanganharian', 'TransaksiController@printlaporankeuanganharian')->name('laporankeuanganharian.print');
    Route::get('/{id}/laporankeuanganbulanan', 'TransaksiController@printlaporankeuanganbulanan')->name('laporankeuanganbulanan.print');
    Route::get('/{id}/laporankeuangantahunan', 'TransaksiController@printlaporankeuangantahunan')->name('laporankeuangantahunan.print');
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