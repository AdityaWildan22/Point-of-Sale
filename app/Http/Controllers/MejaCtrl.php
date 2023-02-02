<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;

class MejaCtrl extends Controller
{
    function index(){
        //Data Member
        $data = [
            "title" => "Data Meja",
            "page_title" => "Data Meja",
            "meja" =>Meja::All()
        ];

        return view("mejas.data_meja",$data);
    }

    function form(Request $req){
        $mode = $req->id!= "" ? "Edit Meja " : "Tambah Meja Baru ";
        $data = [
            "title" => $mode,
            "page_title" => $mode,
            "rsMeja" => Meja::where("id_meja",$req->id)->first()
        ];

        return view("mejas.frm_meja",$data);
    }

    function save(Request $req){
        // Validation
        $req->validate(
            // Rule
            [
                "kd_meja" => "required|unique:cafe_meja,kd_meja,".$req->input("id_meja").",id_meja",
                "kapasitas" => "required",
                "status" => "required",
            ],
            // Message Error
            [
                "kd_meja.required" => "Kode Meja Wajib diisi !!",            
                "kd_meja.unique" => "Kode Meja Sudah Digunakan !!",
                "kapasitas.required" => "Kapasitas Wajib diisi !!",
                "status.required" => "Kapasitas Wajib diisi !!",
            ]
        );
    
        try {
            // Proses Save
            Meja::UpdateorCreate(
                [
                    "id_meja" => $req->input("id_meja")
                ],
                [
                    "kd_meja"=>$req->input("kd_meja"),
                    "kapasitas"=>$req->input("kapasitas"),
                    "status"=>$req->input("status"),
                ]
            );
    
            // Data yang dibwa saat berhasil
            $mess = ["type"=>"success","text"=>"Data Berhasil disimpan !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal disimpan !!"];
        }
    
        // Redirect
        return redirect('meja')->with($mess);
        } 
    
        function delete(Request $req){
        try {
            Meja::where("id_meja",$req->id)->delete();
            $mess = ["type"=>"success","text"=>"Data Berhasil dihapus !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal dihapus !!"];
        }
        // Redirect
        return redirect('meja')->with($mess);
    }
}
