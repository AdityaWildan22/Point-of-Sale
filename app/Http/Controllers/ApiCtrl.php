<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\User;
use App\Models\Member;

class ApiCtrl extends Controller
{
    function get_menu(Request $req) {
       if($req->kategori){
           $menu = Menu::where("kategori",$req->kategori)->get();
        } else {
            $menu = Menu::All();
        }
        return response()->json($menu);
    }

    function menu_fav() {
        $menu = DB::table("cafe_menu")
        ->join("tb_detail_transaksi","tb_detail_transaksi.id_menu","=","cafe_menu.id_menu")
        ->selectRaw("cafe_menu.*,SUM(tb_detail_transaksi.jumlah) as total")
        ->groupByRaw("cafe_menu.id_menu,cafe_menu.kd_menu,cafe_menu.nm_menu,cafe_menu.kategori,cafe_menu.dapur,cafe_menu.harga,cafe_menu.stok,cafe_menu.satuan,cafe_menu.desc,cafe_menu.foto,cafe_menu.fav,cafe_menu.created_at,cafe_menu.updated_at")
        ->orderByRaw("SUM(tb_detail_transaksi.jumlah) DESC")
        ->limit(10)
        ->get();    

        return response()->json(collect($menu));
    }

    function update_menu_fav(Request $req){
        Menu::where("id_menu",$req->id)
        ->update([
            "fav" => $req->fav    
        ]);

        return response()->json(["error"=>0]);
    }

    function login(Request $req){

        $login = $req->json()->all();
        $user = User::where("email",$login["email"])->first();

        if($user){
           if(Hash::check($login["password"],$user->password)){
               $member = Member::where("id_member",$user->id_member)->first();
                $mess = ["error"=> 0,"mess"=>"Berhasil Login !","data"=>["user"=>collect($user),"member"=>collect($member)]];
           } else {
            $mess = ["error"=> 1,"mess"=>"Password Salah !","data"=>null];
           }

        } else {
            $mess = ["error"=> 1,"mess"=>"Email Tidak Ditemukan !","data"=>null];
        }

        return response()->json($mess);
    }

    function registrasi(Request $req){
        //Ambil Data JSON Dari Ionic
        $reg = $req->json()->all();

        //Validasi
        $valid = Validator::make(
            $reg,
            //Rule
            [
                "email" => "email|unique:users,email",
            ],
            //Message Error
            [
                "email.unique" => " Email Sudah Terdaftar !!",
            ]
        );

        if($valid->fails()){
            $mess = ["error"=>1,"mess"=>"Email Sudah Digunakan !","data"=>null];
        } else {
            //Proses Simpan
            $save = User::create([
                "name"=>$reg["name"],
                "email"=>$reg["email"],
                "password"=>Hash::make($reg["password"]),
                "role"=>"Member",
                "status"=>1
            ]);

            if($save){
                $user = User::where("email",$reg["email"])->first();
                //$user->notify(new WelcomeMail());
                $mess = ["error"=>0,"mess"=>"Registrasi Berhasil !","data"=>collect($user)];
            } else {
                //Jika Gagal Menyimpan
                $mess = ["error"=>1,"mess"=>"Maaf Ada Kesalahan !","data"=>null];
            }
        }

        return response()->json($mess);
    }

    function member(Request $req){
        $dtMember = $req->json()->all();
        $kode = "SC".Str::upper(Str::random(3));
            //return response()->json($dtMember);
            //Update Data Member
            $save = Member::UpdateorCreate(
                [
                    "id_member" => $dtMember["id_member"]
                ],
                [
                    "kd_member"=>$kode,
                    "nm_member"=>$dtMember["nm_member"],
                    "alamat"=>$dtMember["alamat"],
                    "kota"=>$dtMember["kota"],
                    "telp"=>$dtMember["telp"],
                    "jk"=>$dtMember["jk"],
                    "status"=>1,
                    "foto"=>$dtMember["foto"],
                ]
            );

            if($save){
                //Get Data User And Member
                $user = User::where("id",$dtMember["user_id"])->first();
                $member = Member::where("kd_member",$kode)->first();

                //Update id Member to Users Table Where Success  Save Member
                if($dtMember["id_member"]==""){
                    User::where("id",$dtMember["user_id"])->update([
                        "id_member"=>$member->id_member
                    ]);
                }

                if($dtMember["id_member"]==""){
                    $mess = ["error"=>0,"mess"=>"Registrasi Member Behasil !","data"=>["user"=>collect($user),"member"=>collect($member)]];
                } else {
                    $mess = ["error"=>0,"mess"=>"Data Berhasil Di Update !","data"=>["user"=>collect($user),"member"=>collect($member)]];
                }

            } else {
                $mess = ["error"=>1,"mess"=>"Maaf Ada Kesalahan !","data"=>null];
            }
        return response()->json($mess);
    }

    function get_transaksi(Request $req){
         $transaksi = DB::table("tb_transaksi")
        ->join("cafe_member","cafe_member.id_member","=","tb_transaksi.id_member")
        ->where("tb_transaksi.id_member",$req->id_member)->get();
        return response()->json($transaksi);
    }

    function User(Request $req){
        $dtUser = $req->json()->all();

        //Update User
        if($dtUser["password"]){
            $save = User::where("id",$dtUser["id"])->update([
                "name"=>$dtUser["name"],
                "password"=>Hash::make($dtUser["password"])
            ]);
        } else {
            $save = User::where("id",$dtUser["id"])->update([
                "name"=>$dtUser["name"],
            ]);
        }

        if($save){
            //Get Data User
            $user = User::where("id",$dtUser["id"])->first();

            $mess = ["error"=>0,"mess"=>"Data User Berhasil di Update !","data"=>["user"=>collect($user)]];
        } else {
            $mess = ["error"=>1,"mess"=>"Data User Gagal di Update !","data"=>null];
        }

        return response()->json($mess);
    }
}
