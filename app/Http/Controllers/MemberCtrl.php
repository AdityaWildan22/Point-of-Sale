<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class MemberCtrl extends Controller
{
    //
    function index(){
        //Data Member
        $data = [
            "title" => "Data Member",
            "page_title" => "Data Member",
            "members" => Member::All()
        ];

        return view("members.data_member",$data);
    }

    function form(Request $req){
        $mode = $req->id!= "" ? "Edit Member " : " Tambah Member Baru ";
        $data = [
            "title" => $mode,
            "page_title" => $mode,
            "rsMember" => Member::where("id_member",$req->id)->first()
        ];

        return view("members.frm_member",$data);
    }

    function save(Request $req){
        // Validation
        $req->validate(
            // Rule
            [
                "kd_member" => "required|size:5|unique:cafe_member,kd_member,".$req->input("id_member").",id_member",
                "nm_member" => "required",
                "alamat" =>"required",
                "kota" => "required",
                "telp" => "required|numeric|digits_between:11,13|unique:cafe_member,telp,".$req->input("id_member").",id_member",
                "jk" => "required",
                "status" => "required",
            ],
             // Message Error
             [
                "kd_member.required" => "Kode Member  Harus diisi !!",
                "kd_member.size" => "Kode Member Harus 5 Karakter !!",
                "kd_member.unique" => "Kode Member Sudah digunakan",
                "nm_member.required" => "Nama Member Harus diisi !!",
                "kota.required" => "Kota  Harus diisi !!",
                "telp.required" => "Telepon  Harus diisi !!",
                "telp.numeric" => "Telepon Harus diisi dengan angka !!",
                "telp.digits_between" => "Telepon  Harus 11 - 13 digits !!",
                "telp.unique" => "Telepon sudah digunakan !!",
                "jk.required" => "Jenis Kelamin  Harus diisi !!",
                "status.required" => "Status  Harus diisi !!",
            ]
        );
        try{
            // Proses Save
            Member::UpdateorCreate(
                [
                    "id_member" => $req->input("id_member")
                ],
                [
                    "kd_member"=>$req->input("kd_member"),
                    "nm_member"=>$req->input("nm_member"),
                    "alamat"=>$req->input("alamat"),
                    "kota"=>$req->input("kota"),
                    "telp"=>$req->input("telp"),
                    "jk"=>$req->input("jk"),
                    "status"=>$req->input("status"),
                    "foto"=>$req->input("foto"),
                ]
            );
            // Data yang dibawa saat berhasil
            $mess = ["type"=>"success","text"=>"Data berhasil disimpan !!!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data gagal disimpan !!!"];
        }

        // Redirect
        return redirect('member')->with($mess);
    }

    function delete(Request $req){
        try{ 
            Member::where("id_member",$req->id)->delete();
            $mess = ["type"=>"success","text"=>"Data berhasil dihapus !!!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data gagal dihapus !!!"];
        }
        // Redirect
        return redirect('member')->with($mess);
    }

    function card_member(Request $req){
        $member = DB::table("cafe_member")
        ->select("cafe_member.*")
        ->where("cafe_member.id_member",$req->id)
        // ->get(); 
        ->first(); 

        $data = [
            "rsMember" => $member
        ];
    //    dd($data);
        return view("members.member_card",$data);
    }
}
