<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\costumer;
use App\Models\barang;
use App\Models\notif;

class OrderController extends Controller
{
    function index(){
        return response()->json(["status" => "success", "data"=> order::with("costumer:id,nama,alamat")->get()], 200);

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
            "status" =>  "packing" ,
            "total" => $total ,
            "note"  => $request->note,

        ]);
        $this->createNotif($plg->no_pelanggan,$noTrans,"Barang dipacking","Pesanan anda sedang dipacking..");
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
    function show($id){
        $data = order::where("uuid",$id)->With(["costumer:id,nama,no_plg,no_hp,email,alamat"])->with('detail')->first();
        return response()->json($data, 200);
    }
    function destroy($id){
        order::where('uuid',$id)->delete();
        
    }
    function noTrans() {
        $characters ='1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';

        for ($i = 0; $i < 10 ; $i++) {
            $result .= $characters[rand(0, strlen($characters) - 1)]; // Menggunakan mt_rand() untuk angka acak
        }
        return $result;
    }
    function updateStatus(Request $request){
        $order = order::where('no_trans',$request->kode)->first();
        $p= costumer::where('id',$order->costumer_id)->first();
        // return $order;
        $status = $order->status;
        if ($request->status == "batalkan"){
            $order->update(['status'=>'Dibatalkan']);
            $this->createNotif($p->no_plg,$order->no_trans,"Order Dibatalkan","Pesanan Dibatalkan..");      
        } else{
        
        if ($status == "packing"){
                if ($order->type =='kirim'){
                    $order->update(['status'=>'dikirim']);
                    $this->createNotif($p->no_plg,$order->no_trans,"Barang Dikirim","Pesanan anda sedang Dikirim ke alamat..");
                }
                else {
                    $order->update(['status'=>'menunggu diambil']);
                    $this->createNotif($p->no_plg,$order->no_trans,"Packing Selesai","Silahkan Ambil Pesanan Di Toko Kami. ");
                }
            }
        else{    
                $order->update(['status'=>'selesai']);
                $this->createNotif($p->no_plg,$order->no_trans,"Selesai","Orderan Telah Telesai, Terimakasih Sudah Order");
            }
        }
        return response()->json($order,200);
    }
    function ordercos($id){
        // return $id;
        return response()->json(['data'=>order::join('costumers','costumer_id',"costumers.id")->where('no_plg',$id)->get()], 200);
    }
    function createNotif($pelangan,$kodeTrans,$title,$isi){
       return notif::create([
            "pelanggan" => $pelangan,
            "no_trans" => $kodeTrans,
            "title" => $title,
            "isi" => $isi,
        ]);
    }
}

