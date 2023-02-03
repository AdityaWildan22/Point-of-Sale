<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class ReportCtrl extends Controller
{

    function index(){
        $data = [
            "title" => "Laporan Transaksi",
            "page_title" => "Laporan Transaksi",
            "member" => Member::All()
            // "users" => User::All()
        ];

        return view("reports.frm_report",$data);
    }

    function rpt_transaksi_all(){
        // Generate Data Menggunakan Query Builder
        $transaksi = DB::table("tb_transaksi")
        ->join("users","tb_transaksi.id_kasir","=","users.id")
        ->join("cafe_member","tb_transaksi.id_member","=","cafe_member.id_member")
        ->join("cafe_meja","tb_transaksi.id_meja","=","cafe_meja.id_meja")
        ->select("tb_transaksi.*","users.name","cafe_member.nm_member","cafe_meja.kd_meja")
        ->get();

        $data = [
            "rsTransaksi" =>$transaksi,
            "pajak" => 0,
            "total" => 0,
            "no" =>1
        ];

        return view("reports.rpt_transaksi",$data);
    }    

    function rpt_transaksi(Request $req){

        $tgl_awal = date("Y-m-d",strtotime($req->input("tgl_awal")));
        $tgl_akhir = date("Y-m-d",strtotime($req->input("tgl_akhir")));

        $transaksi = DB::table("tb_transaksi")
        ->join("users","tb_transaksi.id_kasir","=","users.id")
        ->join("cafe_member","tb_transaksi.id_member","=","cafe_member.id_member")
        ->join("cafe_meja","tb_transaksi.id_meja","=","cafe_meja.id_meja")
        ->select("tb_transaksi.*","users.name","cafe_member.nm_member","cafe_meja.kd_meja")
        ->where(DB::raw("DATE_FORMAT(tb_transaksi.tanggal,'%Y-%m-%d')"),">=",$tgl_awal)
        ->where(DB::raw("DATE_FORMAT(tb_transaksi.tanggal,'%Y-%m-%d')"),"<=",$tgl_akhir)
        ->get();

        $data = [
            "rsTransaksi" =>$transaksi,
            "pajak" => 0,
            "total" => 0,
            "no" =>1
        ];

        return view("reports.rpt_transaksi",$data);
    }

    function rpt_transaksi_member(Request $req){
        $transaksi = DB::table("tb_transaksi")
        ->join("users","tb_transaksi.id_kasir","=","users.id")
        ->join("cafe_member","tb_transaksi.id_member","=","cafe_member.id_member")
        ->join("cafe_meja","tb_transaksi.id_meja","=","cafe_meja.id_meja")
        ->select("tb_transaksi.*","users.name","cafe_member.nm_member","cafe_meja.kd_meja")
        ->where("cafe_member.id_member","=",$req->input("id_member"))
        ->get();

        $data = [
            "rsTransaksi" =>$transaksi,
            "pajak" => 0,
            "total" => 0,
            "no" =>1
        ];

        return view("reports.rpt_transaksi",$data);
    }

    // function rpt_transaksi_kasir(Request $req){
    //     $transaksi = DB::table("tb_transaksi")
    //     ->join("users","tb_transaksi.id_kasir","=","users.id")
    //     ->join("cafe_member","tb_transaksi.id_member","=","cafe_member.id_member")
    //     ->join("cafe_meja","tb_transaksi.id_meja","=","cafe_meja.id_meja")
    //     ->select("tb_transaksi.*","users.name","cafe_member.nm_member","cafe_meja.kd_meja")
    //     ->where("users.id","=",$req->input("id"))
    //     ->get();

    //     $data = [
    //         "rsTransaksi" =>$transaksi,
    //         "pajak" => 0,
    //         "total" => 0
    //     ];

    //     return view("reports.rpt_transaksi",$data);
    // }

    function rpt_menu(){
        $menu = DB::table("cafe_menu")
        ->select("cafe_menu.*")
        ->get();

        $data = [
            "rsMenu" =>$menu,
            "no" =>1
        ];
       
        return view("reports.rpt_menu",$data);

    }

    function rpt_member(){
        $member = DB::table("cafe_member")
        ->select("cafe_member.*")
        ->get();

        $data = [
            "rsMember" =>$member,
            "no" =>1
        ];

        return view("reports.rpt_member",$data);
    }

}
