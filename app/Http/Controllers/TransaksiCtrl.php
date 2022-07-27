<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\Member;
use App\Models\Meja;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;



class TransaksiCtrl extends Controller
{
    function index(){
        //Grandtotal Tanpa SQL
        $transaksi = DB::select("SELECT t.*,u.name,mb.nm_member,mj.kd_meja FROM tb_transaksi AS t 
        INNER JOIN users AS u ON t.id_kasir = u.id
        INNER JOIN cafe_member AS mb ON t.id_member = mb.id_member
        INNER JOIN cafe_meja AS mj ON t.id_meja = mj.id_meja");

        //Data Page
        $data = [
            "title" => "Transaksi",
            "page_title" => "Transaksi",
            "transaksi" => $transaksi
        ];

        return view("transaksi.data_transaksi",$data);
    }
    function form(){   
        // Data Page
        $data = [
            "title" => "Transaksi",
            "page_title" => "Transaksi",
            "menus" => Menu::where("stok","Available")->get(),
            "members" => Member::All(),
            "meja" => Meja::All()
        ];

        return view("transaksi.frm_transaksi",$data);
    }

    function save(Request $req){
        // dd($req->all());
        // Generate No Nota
        $nota = "N".date("Ymdhis").Str::upper(Str::random(4));

        // Get Next id Transaksi
        $transaksi=DB::select("SHOW TABLE STATUS LIKE 'tb_transaksi'");
        $id_transaksi=$transaksi[0]->Auto_increment;

        // Save Transaksi
        Transaksi::create([
            "nota"      => $nota,
            "tanggal"   => date("Y-m-d h:i:s"),
            "id_kasir"  => Auth::user()->id,
            "id_member" => $req->input("id_member"),
            "id_meja"   => $req->input("id_meja"),
            "ppn"       => $req->input("ppn"),
            "diskon"    => $req->input("diskon"),
            "gtotal"    => $req->input("gtotal"),
            "status"    => 1,
        ]);

        // Save Detail Transaksi
        $id_menu    = $req->input("id_menu");
        $harga      = $req->input("harga");
        $jumlah     = $req->input("jumlah");

        // Perulangan 
        for($i=0;$i<count($id_menu);$i++){
            DetailTransaksi::create([
                "id_transaksi" => $id_transaksi,
                "id_menu"      => $id_menu[$i],
                "harga"        => $harga[$i],
                "jumlah"       => $jumlah[$i],
            ]);
        }

        return json_encode(["error"=>0,"type"=>"success","message"=>"Data Berhasil Disimpan !!!","id_transaksi"=>$id_transaksi]);
    }

    function generate_nota(Request $req){
        // Generate Data Menggunakan Query Builder
        $transaksi = DB::table("tb_transaksi")
        ->join("users","tb_transaksi.id_kasir","=","users.id")
        ->join("cafe_member","tb_transaksi.id_member","=","cafe_member.id_member")
        ->join("cafe_meja","tb_transaksi.id_meja","=","cafe_meja.id_meja")
        ->select("tb_transaksi.*","users.name","cafe_member.nm_member","cafe_meja.kd_meja")
        ->where("tb_transaksi.id_transaksi",$req->id)
        ->first();
       

        $detail = DB::table("tb_detail_transaksi")
        ->join("cafe_menu","tb_detail_transaksi.id_menu","=","cafe_menu.id_menu")
        ->select("tb_detail_transaksi.*","cafe_menu.nm_menu",DB::raw("(tb_detail_transaksi.harga * tb_detail_transaksi.jumlah) as subtotal"))
        ->where("tb_detail_transaksi.id_transaksi",$req->id)
        ->get();

        // Data to View
        $data = [
            "rsTransaksi" => $transaksi,
            "rsDetail"    => $detail,
            "total"       => 0,            
        ];

        return view("transaksi.nota",$data);
    }

    //Hapus
    function delete(Request $req){
        try {
            Transaksi::where("id_transaksi",$req->id)->delete();
            DetailTransaksi::where("id_transaksi",$req->id)->delete();
            $mess = ["type"=>"success","text"=>"Data Berhasil dihapus !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal dihapus !!"];
        }
        // Redirect
        return redirect('transaksi')->with($mess);
        
        
    }


}
