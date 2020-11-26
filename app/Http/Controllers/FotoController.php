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
     $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('pendaftarans.id')->first();
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

    $image1 = $request->file('image1');
    $nameImage = $request->file('image1')->getClientOriginalName();

    $oriPath = public_path() . '/normal_images/' . $nameImage;
    $oriImage = Image::make($image1)->save($oriPath);

    $thumbPath = public_path() . '/thumbnail_images/' . $nameImage;
    $thumbImage = Image::make($image1)->resize(800, 600)->save($thumbPath, 10);

    $image2 = $request->file('image2');
    $nameImage = $request->file('image2')->getClientOriginalName();

    $oriPath = public_path() . '/normal_images/' . $nameImage;
    $oriImage = Image::make($image2)->save($oriPath);

    $thumbPath = public_path() . '/thumbnail_images/' . $nameImage;
    $thumbImage = Image::make($image2)->resize(800, 600)->save($thumbPath, 10);

    $image3 = $request->file('image3');
    $nameImage = $request->file('image3')->getClientOriginalName();

    $oriPath = public_path() . '/normal_images/' . $nameImage;
    $oriImage = Image::make($image3)->save($oriPath);

    $thumbPath = public_path() . '/thumbnail_images/' . $nameImage;
    $thumbImage = Image::make($image3)->resize(800, 600)->save($thumbPath, 10);

    $image4 = $request->file('image4');
    $nameImage = $request->file('image4')->getClientOriginalName();

    $oriPath = public_path() . '/normal_images/' . $nameImage;
    $oriImage = Image::make($image4)->save($oriPath);

    $thumbPath = public_path() . '/thumbnail_images/' . $nameImage;
    $thumbImage = Image::make($image4)->resize(800, 600)->save($thumbPath, 10);
    $img = Image::make(file_get_contents($image1));

    $data = Fotomentah::create([
            'nouji'                => 'BM',
            'fotodepanmentah'      => base64_encode(Image::make($image1)->resize(800, 600)->save($thumbPath, 10)),
            'fotobelakangmentah'   => base64_encode(Image::make($image2)->resize(800, 600)->save($thumbPath, 10)),
            'fotokananmentah'      => base64_encode(Image::make($image3)->resize(800, 600)->save($thumbPath, 10)),
            'fotokirimentah'       => base64_encode(Image::make($image4)->resize(800, 600)->save($thumbPath, 10)),
            'statuskompres'        => '0',
            ]);

    // $data = Fotomentah::create([
    //         'nouji'                => 'BM',
    //         'fotodepanmentah'      => base64_encode(file_get_contents($image1)),
    //         'fotobelakangmentah'   => base64_encode(file_get_contents($image1)),
    //         'fotokananmentah'      => base64_encode(file_get_contents($image1)),
    //         'fotokirimentah'       => base64_encode(file_get_contents($image1)),
    //         'statuskompres'        => '0',
    //         ]);

    // $cek = Fotomentah::where('nouji','BM')->toSql();
    // return print_r(base64_encode($thumbImage));
    // return print_r(base64_encode(base64_encode($img)));
    return redirect()->back()->with('success', 'Berhasil');
  }


}
