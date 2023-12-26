<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\kategori;
use File;

class BarangController extends Controller
{
    function index(){
        $data = ["status"=>"success","data" =>barang::get()];
        return response()->json($data, 200, );["data" =>barang::get()];
    }
    function store(Request $request){
        $photo = $request->file('gambar');
        $name =str_replace("_"," " ,$request->nama);
        $imagename = $name.'.'.$photo->getClientOriginalExtension();

        // Menyimpan file photo ke folder public/photos (pastikan folder sudah ada dan writable)
        $photoPath = $photo->move(public_path('image/barang'),$imagename);
        $create =barang::create([
            'uuid' => uniqid(),
            'kategori_id' => $request->kategori,
            'nama' => $request->nama,
            'gambar' => $imagename,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
     ]);

     if($create){
        return response()->json(['succsess' => 'berhasil ditambahkan']);
    }
    return response()->json(['fail' => ' gagal ditambahkan']);

        
    }
    function show($id){
        return response()->json(barang::where('uuid',$id)->first(), 200);
    }
    function update (Request $request,$uuid){
        //JIKA GAMBAR DIUBAH
        if ($request->file('gambar')){
            $photo = $request->file('gambar');
            //SIMPAN GAMBAR BARU
            $name =str_replace("_"," " ,$request->nama);
            $imagename = $name.'.'.$photo->getClientOriginalExtension();
            $photoPath = $photo->move(public_path('image/barang'),$imagename);
            //MENHAPUS GAMBAR SEBELUMNYA
            $data = barang::where('uuid',$uuid)->first();
            File::delete('image/barang/'.$data->gambar);
            //UPDATE DATA
            $create =barang::where('uuid',$uuid)->update([
                'kategori_id' => $request->kategori,
                'nama' => $request->nama,
                'gambar' => $imagename,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        //JIKA TIDAK MENGUBAH GAMBAR
        else {
           $create = barang::where('uuid',$uuid)->update([
                'kategori_id' => $request->kategori,
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        if($create){
            return response()->json(['succsess' => ' berhasil diubah', 'data' => $uuid]);
        }
        return response()->json(['fail' => ' gagal diubah', 'data' => $uuid]);

        
     }

    function destroy($id){
        $data = barang::where('uuid',$id)->first();
        //HAPUS GAMBAR
        if (file_exists(public_path('image/barang/'.$data->gambar))){
            File::delete('image/barang/'.$data->gambar);
        }
        //HAPUS DATA DARU DATABASE
        $data->delete();
        if($data->delete()){
            return response()->json(['succsess' => ' berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => ' gagal dihapus', 'data' => $id]);

    }

    function getBarang(){
        $data = ["status"=>"success","data" =>barang::inRandomOrder()->take(20)->get()];
        return response()->json($data, 200, );
    }
    function getBarangKategori(Request $request){
        if ($request->kategori){
        $kategori =kategori::where('nama',$request->kategori)->first();
        $data = ["status"=>"success","data" =>barang::where('kategori_id',$kategori->id)->take(20)->get()];
        return response()->json($data, 200, );
        }
        if ($request->search){
            $array = explode(" ", $request->search);
            $query = barang::query();
            $query->where('nama',$request->search);
            $d= $query->take(10)->get();
            $results=$d;
            if(count($d)== 0 ){
            for ($i=0; $i < count($array); $i++){ 
                if (count($array) === 1) {
                    // The first condition uses 'where', subsequent ones use 'orWhere'
                    $query->orWhere('nama', 'LIKE', '%' . $array[$i] . '%');
                } else {
                    $query->orWhere('nama', 'LIKE', '%' . $array[$i] . '%');
                }
            }
            $results = $query->take(10)->get();
            }
            if(count($results)== 0 ){
            $data = ["status"=>"success","data" => "notfound" ];
            }else $data = ["status"=>"success","data" => $results ];

            
            return response()->json($data, 200, );
            
        }
    }

}
