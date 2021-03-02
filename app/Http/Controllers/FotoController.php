<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Fotomentah;
use App\Pendaftaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FotoController extends Controller
{
    public function getImage($id)
  {
     $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('pendaftarans.id',$id)->first();
    return view('admin.foto',compact('kendaraan'));
  }

  public function postImage(Request $request)
  {
    $this->validate($request, [
      'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
      'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
      'image3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
      'image4' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
    ]);

    $nouji = $request->nouji;
    $image1 = $request->file('image1');
    $image2 = $request->file('image2');
    $image3 = $request->file('image3');
    $image4 = $request->file('image4');
    $cek = Fotomentah::where('nouji',$nouji)->first();

    if (!empty($cek)) {
        $oriPath1   = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakdepan.jpg');
        $oriPath2   = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakkanan.jpg');
        $oriPath3   = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakbelakang.jpg');
        $oriPath4   = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakkiri.jpg');
        $thumbPath1 = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakdepan.jpg');
        $thumbPath2 = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakkanan.jpg');
        $thumbPath3 = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakbelakang.jpg');
        $thumbPath4 = Image::make(public_path() . '/normal_images/' . $nouji.'-tampakkiri.jpg');
        if (!empty($image1)) {
            $oriPath1->destroy();
            $thumbPath1->destroy();
        }
        if (!empty($image2)) {
            $oriPath2->destroy();
            $thumbPath2->destroy();
        }
        if (!empty($image3)) {
            $oriPath3->destroy();
            $thumbPath3->destroy();
        }
        if (!empty($image4)) {
            $oriPath4->destroy();
            $thumbPath4->destroy();
        }
    }

    $oriPath1 = public_path() . '/normal_images/' . $nouji.'-tampakdepan.jpg';
    $oriImage = Image::make($image1)->save($oriPath1);

    $thumbPath1 = public_path() . '/thumbnail_images/' . $nouji.'-tampakdepan.jpg';
    $thumbImage = Image::make($image1)->resize(600, 600)->save($thumbPath1, 10);

    $oriPath2 = public_path() . '/normal_images/' . $nouji.'-tampakkanan.jpg';
    $oriImage = Image::make($image2)->save($oriPath2);

    $thumbPath2 = public_path() . '/thumbnail_images/' . $nouji.'-tampakkanan.jpg';
    $thumbImage = Image::make($image2)->resize(600, 600)->save($thumbPath2, 10);

    $oriPath3 = public_path() . '/normal_images/' . $nouji.'-tampakbelakang.jpg';
    $oriImage = Image::make($image3)->save($oriPath3);

    $thumbPath3 = public_path() . '/thumbnail_images/' . $nouji.'-tampakbelakang.jpg';
    $thumbImage = Image::make($image3)->resize(600, 600)->save($thumbPath3, 10);

    $oriPath4 = public_path() . '/normal_images/' . $nouji.'-tampakkiri.jpg';
    $oriImage = Image::make($image4)->save($oriPath4);

    $thumbPath4 = public_path() . '/thumbnail_images/' . $nouji.'-tampakkiri.jpg';
    $thumbImage = Image::make($image4)->resize(600, 600)->save($thumbPath4, 10);

    if (empty($cek)) {
       $data = Fotomentah::create([
            'nouji'                => $nouji,
            'fotodepanmentah'      => file_get_contents($thumbPath1),
            'fotobelakangmentah'   => file_get_contents($thumbPath3),
            'fotokananmentah'      => file_get_contents($thumbPath2),
            'fotokirimentah'       => file_get_contents($thumbPath4),
            'statuskompres'        => '0',
            ]);
    }else{
        $foto = Fotomentah::where('nouji',$nouji)->first();
        $foto->fotodepanmentah    = file_get_contents($thumbPath1);
        $foto->fotobelakangmentah = file_get_contents($thumbPath3);
        $foto->fotokananmentah    = file_get_contents($thumbPath2);
        $foto->fotokirimentah     = file_get_contents($thumbPath4);
        $foto->save();
    }    

    return redirect()->back()->with('success', 'Berhasil');
  }


}
