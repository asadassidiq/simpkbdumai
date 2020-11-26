<?php

namespace App\Http\Controllers;
use App\User;
use App\HakAkses;
use App\setHalaman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['users'=> $users]);
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return response()->json(['user' => $users]);
    }

    public function edithakakses($id)
    {
        $halamanakses = User::where('users.id',$id)->leftJoin('hak_akses','users.id','=','hak_akses.user_id')->leftJoin('set_halamen','set_halamen.id','=','hak_akses.setHalaman_id')->get();;
        return response()->json(['halamanakses' => $halamanakses]);
    }

    public function cekhakakses(Request $request)
    {
        $halamanakses = User::where('users.id',$request->user_id)->where('hak_akses.setHalaman_id',$request->halaman)->leftJoin('hak_akses','users.id','=','hak_akses.user_id')->leftJoin('set_halamen','set_halamen.id','=','hak_akses.setHalaman_id')->first();;
        return response()->json(['halamanakses' => $halamanakses]);
    }

    public function cekhakakses1($id)
    {
        $halamanakses = User::where('users.id',$id)->where('hak_akses.setHalaman_id','3')->leftJoin('hak_akses','users.id','=','hak_akses.user_id')->leftJoin('set_halamen','set_halamen.id','=','hak_akses.setHalaman_id')->first();;
        $halamanakses = $halamanakses['view'];
	return response()->json(['halamanakses' => $halamanakses]);
    }

    public function cekhakakses2($id)
    {
        $halamanakses = User::where('users.id',$id)->where('hak_akses.setHalaman_id','4')->leftJoin('hak_akses','users.id','=','hak_akses.user_id')->leftJoin('set_halamen','set_halamen.id','=','hak_akses.setHalaman_id')->first();;
        $halamanakses = $halamanakses['view'];
	return response()->json(['halamanakses' => $halamanakses]);
    }

    public function navakses($id)
    {
        $halamanakses = User::select('setHalaman_id')->where('users.id',$id)->leftJoin('hak_akses','users.id','=','hak_akses.user_id')->get();;
        $halaman= array();
        for ($i=0; $i < count($halamanakses) ; $i++) { 
            array_push($halaman,strval($halamanakses[$i]['setHalaman_id']));
        }
        return response()->json(['halamanakses' => $halaman]);
    }

    public function store(Request $request)
    {
        $data = User::create([
            'name'                 => $request->name,
            'email'                => $request->username,
            'password'             => Hash::make($request->password),
            'level'				   => $request->level,
            ]);
        if ($request->level == 'Pendaftaran') {
        	$hak = [
        			['user_id'=>$data->id, 'setHalaman_id'=> '1', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
        			['user_id'=>$data->id, 'setHalaman_id'=> '2', 'view' => '1', 'add' => '0', 'edit' => '0', 'delete' => '0'],
        		];
        	HakAkses::insert($hak);
        }elseif ($request->level == 'Retribusi') {
        	$hak = [
        			['user_id'=>$data->id, 'setHalaman_id'=> '1', 'view' => '1', 'add' => '0', 'edit' => '0', 'delete' => '0'],
        			['user_id'=>$data->id, 'setHalaman_id'=> '2', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
        		];
        	HakAkses::insert($hak);
        }elseif ($request->level == 'Penguji') {
            $hak = [
                    ['user_id'=>$data->id, 'setHalaman_id'=> '3', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
                    ['user_id'=>$data->id, 'setHalaman_id'=> '4', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
                ];
            HakAkses::insert($hak);
        }elseif ($request->level == 'Verifikator') {
            $hak = [
                    ['user_id'=>$data->id, 'setHalaman_id'=> '3', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
                    ['user_id'=>$data->id, 'setHalaman_id'=> '4', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
                    ['user_id'=>$data->id, 'setHalaman_id'=> '12', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
                ];
            HakAkses::insert($hak);
        }elseif ($request->level == 'Cetak') {
            $hak = [
                    ['user_id'=>$data->id, 'setHalaman_id'=> '10', 'view' => '1', 'add' => '1', 'edit' => '1', 'delete' => '0'],
                ];
            HakAkses::insert($hak);
        }
    }

    public function storehal(Request $request, $id){
        $data = HakAkses::create([
            'user_id'       => $id,
            'setHalaman_id' => $request->halaman,
            'view'          => '1',
            'edit'          => '1',
            'add'           => '1',
            'delete'        => '0',
            ]);
    }

    public function update(Request $request, $id)
    {
        $users = User::find($id);
        $users->name                   = $request->name;
        $users->email               = $request->username;
        $users->level                  = $request->level;
        $users->save();
    }

    public function edithak(Request $request){
        $hak = HakAkses::find($request->id);
        if (!is_null($request->view)) {
            $hak->view                   = $request->view;
        }elseif (!is_null($request->add)) {
            $hak->add                   = $request->add;
        }elseif (!is_null($request->edit)) {
            $hak->edit                   = $request->edit;
        }elseif (!is_null($request->delete)) {
            $hak->delete                   = $request->delete;
        }
        $hak->save();
    }

    public function destroyhalaman($id)
    {
        $post = HakAkses::findOrFail($id)->delete();
    }

    public function halaman()
    {
        $setHalaman = setHalaman::all();
        return response()->json(['setHalaman'=> $setHalaman]);
    }
}
