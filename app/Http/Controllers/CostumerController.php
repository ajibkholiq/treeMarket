<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\costumer;

class CostumerController extends Controller
{
    function index(){
        return response()->json(["status" => "success", "data"=> costumer::get()], 200);
    }
    function store(Request $request){
        $no = $this->noPlg();
        $create = costumer::create([
            'uuid' => uniqid(),
            'nama' => $request->nama, 
            'email' =>$request->email,
            'password' =>$request->password,
            "no_plg"=> "CS".$no,
            "no_hp" =>$request->nohp,
            "alamat" => $request->alamat,
     ]);

        if ($create){
        return response()->json(['status' => 'SUCCESS', 'data' => ["no_pelanggan"=> $no, "nama"=>$request->nama] ]);
        }
    }
    function show($id){
        return response()->json(costumer::where('uuid',$id)->first(), 200);
    }
    function update(Request $request,$uuid){

        $data = costumer::where('no_plg',$uuid)->update([
            'nama' => $request->nama, 
            'email' =>$request->email,
            'password' =>$request->password,
            "no_hp" =>$request->nohp,
            "alamat" => $request->alamat,
        ]);
        return response()->json(['succsess' => 'Pelanggan berhasil diubah', 'data' => $request]);
    }
    function destroy($id){
        $data = costumer::where('uuid',$id)->first();
        $data->delete();
        if($data->delete()){
            return response()->json(['succsess' => 'Pelanggan berhasil dihapus', 'data' => $id]);
        }
        return response()->json(['fail' => 'gagal dihapus', 'data' => $id]);

    }
    function noPlg() {
        $result = '';
        for ($i = 0; $i < 8 ; $i++) {
            $result .= mt_rand(0, 9); // Menggunakan mt_rand() untuk angka acak
        }
        return $result;
    }
    function login(Request $request){
        $user = costumer::where('no_plg',$request->noplg)->first();
        if($user == null){
            return response()->json(["status"=>"Fail","message"=>"Nomor Pelanggan Tidak Ditemukan"], 200);
            }
        if ($user->password == $request->password){
            return response()->json(["status"=>"Success","message"=>"Berhasil Login","data" => $user], 200);
        }
        return response()->json(["status"=>"Fail","message"=>"Kata Sandi Salah"], 200);
        
    }
}
