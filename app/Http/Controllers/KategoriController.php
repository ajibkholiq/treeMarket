<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
class KategoriController extends Controller
{
    function index(){
        return response()->json(["status"=>"success", "data"=>kategori::get()], 200,);
        // return ["data" =>kategori::get()];
    }
    function store(Request $request){
        $create =kategori::create([
               'uuid' => uniqid(),
               'nama' => $request->nama,
               'remark' => $request->remark,
        ]);
   
           if ($create){
           return response()->json(['succsess' => 'Unit berhasil ditambahkan', 'data' => $request]);

           }
    }
    function show($id){
        return response()->json(kategori::where('uuid',$id)->first(), 200);

    }
    function update(Request $request,$uuid){
        $data = kategori::where('uuid',$uuid)->update([
            'nama' => $request->nama,
            'remark' => $request->remark,
        ]);
        return response()->json(['succsess' => 'Unit berhasil diubah', 'data' => $request]);
    }
    function destroy($id){
        $data = kategori::where('uuid',$id)->first();
        $data->delete();
        if($data->delete()){
            return response()->json(['succsess' => 'Unit berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'Unit gagal dihapus', 'data' => $id]);

    }
    function getKategori(){
        $data = ["status"=>"success","data" =>Kategori::inRandomOrder()->take(8)->get()];
        return response()->json($data, 200, );
    
    }
}
