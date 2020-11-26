<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Itemuji;
use App\Groupuji;
;

class SettingController extends Controller
{
    public function index()
    {
        $items = Itemuji::leftJoin('groupujis','groupujis.id','=','itemujis.groupuji_id')->get();
        return response()->json(['items'=> $items]);
    }

    public function indexpos()
    {
        $itempos = array();
        $items = Itemuji::select('groupuji_id')->leftJoin('groupujis','groupujis.id','=','itemujis.groupuji_id')->orderBy('itemujis.id', 'asc')->get();
        foreach ($items as $item) {
            array_push($itempos,$item->groupuji_id);
        }
        return response()->json(['items'=> $itempos ]);
    }

    public function indexgroup()
    {
        $items = Groupuji::all();
        return response()->json(['items'=> $items]);
    }

    public function update(Request $request, $id)
    {
        $post = Itemuji::find($id);
        $post->groupuji_id = $request->groupuji_id;
        $post->save();
    }
}
