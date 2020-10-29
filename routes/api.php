<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => 'auth'], function ($router) {

    Route::get('users', 'ManagementController@index');
    Route::delete('users/{id}', 'ManagementController@destroy');
    Route::patch('user/edit/{id}', 'ManagementController@update');
    Route::post('user/new', 'ManagementController@store');
    Route::get('user/{id}', 'ManagementController@edit');
    Route::get('halamanakses/{id}', 'ManagementController@edithakakses');
    Route::post('cekakses/', 'ManagementController@cekhakakses');
    Route::get('cekakses1/{id}', 'ManagementController@cekhakakses1');
    Route::get('cekakses2/{id}', 'ManagementController@cekhakakses2');
    Route::get('navakses/{id}', 'ManagementController@navakses');
    Route::post('edithak', 'ManagementController@edithak');
    Route::get('halaman', 'ManagementController@halaman');
    Route::post('addhalaman/{id}', 'ManagementController@storehal');
    Route::delete('delhalaman/{id}', 'ManagementController@destroyhalaman');

    Route::get('pendaftarans', 'PendaftaranController@index');
    Route::get('pendaftaranall', 'PendaftaranController@indexall');
    Route::get('pendaftaransnu', 'PendaftaranController@indexnu');
    Route::get('pendaftaransallnu', 'PendaftaranController@indexallnu');
    Route::get('pendaftaransmu', 'PendaftaranController@indexmu');
    Route::get('pendaftaransallmu', 'PendaftaranController@indexallmu');
    Route::get('pendaftarantrans', 'PendaftaranController@indextrans');
    Route::get('pendaftarantransall', 'PendaftaranController@indextransall');
    Route::get('kodewilayah', 'PendaftaranController@kodewilayah');
    Route::get('kodepenerbitan', 'PendaftaranController@kodepenerbitan');
    Route::delete('pendaftaran/{id}', 'PendaftaranController@destroy');
    Route::patch('pendaftaran/edit/{id}', 'PendaftaranController@update');
    Route::post('pendaftaran/new', 'PendaftaranController@store');
    Route::get('pendaftaran/{id}', 'PendaftaranController@edit');
    Route::get('pendaftaranid/{id}', 'PendaftaranController@show');
    Route::post('caridata', 'PendaftaranController@cari');
    Route::post('lanjutuji/{id}', 'PendaftaranController@lanjutuji');
    Route::get('pendaftaranspos1', 'PendaftaranController@indexpos1');
    Route::get('pendaftaranspos2', 'PendaftaranController@indexpos2');
    Route::get('lulusuji1', 'PendaftaranController@lulusuji1');
    Route::get('lulusuji2', 'PendaftaranController@lulusuji2');
    Route::get('tidaklulusuji1', 'PendaftaranController@tidaklulusuji1');
    Route::get('tidaklulusuji2', 'PendaftaranController@tidaklulusuji2');
    Route::get('verif', 'PendaftaranController@verif');
    Route::get('veriflulus', 'PendaftaranController@veriflulus');
    Route::get('verifgagal', 'PendaftaranController@verifgagal');

    Route::get('datakendaraans', 'DatakendaraanController@index');
    Route::get('mereks', 'DatakendaraanController@merek');
    Route::get('tipe', 'DatakendaraanController@tipe');
    Route::delete('datakendaraan/{id}', 'DatakendaraanController@destroy');
    Route::patch('datakendaraan/edit/{id}', 'DatakendaraanController@update');
    Route::post('datakendaraan/new', 'DatakendaraanController@store');
    Route::get('datakendaraan/{id}', 'DatakendaraanController@edit');

    Route::get('mereks', 'MasterController@merek');
    Route::delete('mereks/{id}', 'MasterController@destroy');
    Route::patch('merek/edit/{id}', 'MasterController@update');
    Route::post('merek/new', 'MasterController@storemerek');
    Route::get('merek/{id}', 'MasterController@edit');

    Route::get('tipe', 'MasterController@tipe');
    Route::delete('tipe/{id}', 'MasterController@destroy');
    Route::patch('tipe/edit/{id}', 'MasterController@update');
    Route::post('tipe/new', 'MasterController@storetipe');
    Route::get('tipe/{id}', 'MasterController@edit');

    Route::get('jeniskendaraan', 'MasterController@jeniskendaraan');
    Route::get('klasifikasi', 'MasterController@klasifikasi');
    Route::delete('klasifikasi/{id}', 'MasterController@destroy');
    Route::patch('klasifikasi/edit/{id}', 'MasterController@update');
    Route::post('klasifikasi/new', 'MasterController@storeklasifikasi');
    Route::get('klasifikasi/{id}', 'MasterController@edit');

    Route::get('jenis', 'MasterController@jenis');
    Route::post('jenis/new', 'MasterController@storejeniskend');
    Route::delete('tipe/{id}', 'MasterController@destroy');
    Route::patch('tipe/edit/{id}', 'MasterController@update');
    Route::post('tipe/new', 'MasterController@storetipe');
    Route::get('tipe/{id}', 'MasterController@edit');

    Route::get('itemuji', 'SettingController@index');
    Route::get('itemujipos', 'SettingController@indexpos');
    Route::get('groupuji', 'SettingController@indexgroup');
    Route::post('setposuji/edit/{id}', 'SettingController@update');

    Route::patch('uji/edit/{id}', 'PengujianController@update');
    Route::patch('pengujian/acc/{id}', 'PengujianController@acc');
    Route::patch('pengujian/rejected/{id}', 'PengujianController@rejected');
    Route::get('uji/{id}', 'PengujianController@edit');
    Route::get('getkami/{id}', 'PengujianController@getkami');

    Route::post('cekhargabuku', 'TransaksiController@cekhargabuku');
    Route::get('registrasi/{id}', 'TransaksiController@registrasi');
    Route::get('retribusi/{id}', 'TransaksiController@retribusi');
    Route::get('biayadenda', 'TransaksiController@biayadenda');
    Route::get('biayaplatuji', 'TransaksiController@biayaplatuji');
    Route::get('biayastiker', 'TransaksiController@biayastiker');
    Route::post('transaksi/new', 'TransaksiController@store');
    Route::patch('transaksi/edit/{id}', 'TransaksiController@update');
    Route::delete('transaksi/{id}', 'TransaksiController@destroy');


});