<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\costumer;
use App\Models\barang;

class OrderController extends Controller
{
    function index(){

    }
    function store(Request $request){
        $data =  json_decode($request->data);
        $type = $request->type;
        $noTrans = $this->noTrans();
        $total = 0;
        $plg = json_decode($request->pelanggan);
        if (count($data) == 1) {$total =  intval(str_replace(["Rp", "."], "" , $data[0]->harga)) * intval($data[0]->jumlah);}
        else{
            for ($i=0; $i < count($data);$i++){
            $total +=  intval(str_replace(["Rp","."], "", $data[$i]->harga))*  intval($data[$i]->jumlah);
            }
        }
        $costumer = costumer::where('no_plg',$plg->no_pelanggan)->first();
        $id=intval($costumer->id);
        $order = order::create([
            "uuid"=>uniqid(),
            "no_trans" => $noTrans,
            "costumer_id" => $id,
            "tgl" => date('Y-m-d H:i:s'),
            "type" => $type ,
            "status" => $type== "kirim"? "packing":"menunggu diambil" ,
            "total" => $total ,
            "note"  => $request->note,

        ]);
        $orderid = order::where('no_trans',$noTrans)->first();
        for ($i=0; $i < count($data);$i++){
            $barang= barang::where('uuid',$data[$i]->id)->first();
            orderDetail::create([
                "order_id" => $orderid->id,
                "nama" =>$data[$i]->nama,
                "gambar" => $data[$i]->gambar,
                "harga" => $data[$i]->harga,
                "jumlah" => $data[$i]->jumlah,
            ]);
            $barang->update(["jumlah"=> $barang->jumlah - $data[$i]->jumlah]);
        }

        if ($order){
            return response()->json(["status" => "success"], 200);
        }
        
    }
    function show(){
        
    }
    function delete(){
        
    }
    function noTrans() {
        $characters ='1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';

        for ($i = 0; $i < 10 ; $i++) {
            $result .= $characters[rand(0, strlen($characters) - 1)]; // Menggunakan mt_rand() untuk angka acak
        }
        return $result;
    }
}
