<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Member;
use App\Models\Meja;
use App\Models\User;
use App\Models\Transaksi;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $rev_year =  DB::select("SELECT SUM(gtotal-ppn) AS total FROM tb_transaksi WHERE DATE_FORMAT(tanggal,'%Y') = '".date("Y")."'");
        $rev_month = DB::select("SELECT SUM(gtotal-ppn) AS total FROM tb_transaksi WHERE DATE_FORMAT(tanggal,'%Y-%m') = '".date("Y-m")."'");
        $rev_week = DB::select("SELECT SUM(gtotal-ppn) AS total
        FROM tb_transaksi
        WHERE YEARWEEK(tanggal)=YEARWEEK(NOW())
        GROUP BY YEARWEEK(tanggal);");
        $rev_day = DB::select("SELECT SUM(gtotal-ppn) AS total FROM tb_transaksi WHERE DATE_FORMAT(tanggal,'%Y-%m-%d') = '".date("Y-m-d")."'");

        $data = [
            "total_user" => User::count(),
            "total_menu" => Menu::count(),
            "total_member" => Member::count(),
            "total_meja" => Meja::count(),
            "total_transaksi" => Transaksi::count(),
            "rev_year" => $rev_year[0],
            "rev_month" => $rev_month[0],
            "rev_week" => $rev_week ? $rev_week[0]->total : 0,
            "rev_day" => $rev_day[0]
           
        ];
        return view("dashboard",$data);

    }

    
}
