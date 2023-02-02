<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuCtrl extends Controller
{
    //
    function index(){
        //Data Menu
        $data = [
            "title" => "Data Menu",
            "page_title" => "Data Menu",
            "menu" => Menu::All()
        ];

        return view("menus.data_menu",$data);
    }

    function form(Request $req){
        $mode = $req->id!= "" ? "Edit Menu" : " Tambah Menu Baru ";
        $data = [
            "title" => $mode,
            "page_title" => $mode,
            "rsMenu" => Menu::where("id_menu",$req->id)->first()
        ];

        return view("menus.frm_menu",$data);
    }

    function save(Request $req){
        // Validation
        $req->validate(
            // Rule
            [
                "kd_menu" => "required","unique:cafe_menu,kd_menu,".$req->input("id_menu").",id_menu",
                "nm_menu" => "required",
                "kategori" => "required",
                "dapur" => "required",
                "satuan" => "required",
                "harga" => "required",
                "stok" => "required",
                "file" => "max:1024"
            ],
            // Message Error
            [
                "kd_menu.required" => "Kode Menu  Harus diisi !!",
                "kd_menu.unique" => "Kode Menu Sudah digunakan",
                "nm_menu.required" => "Nama Menu  Harus diisi !!",
                "kategori.required" => "Kategori  Harus diisi !!",
                "dapur.required" => "Dapur Harus diisi !!",
                "satuan.required" => "Satuan Harus diisi !!",
                "harga.required" => "Harga  Harus diisi !!",
                "stok.required" => "Stok  Harus diisi !!",
                "kd_menu.required" => "Kode Menu  Harus diisi !!",
                "file.max" => "File Foto Terlalu Besar"
            ]
        );
    
        try {
            // Proses Save
            Menu::UpdateorCreate(
                [
                    "id_menu" => $req->input("id_menu")
                ],
                [
                    "kd_menu"=>$req->input("kd_menu"),
                    "nm_menu"=>$req->input("nm_menu"),
                    "kategori"=>$req->input("kategori"),
                    "dapur"=>$req->input("dapur"),
                    "harga"=>$req->input("harga"),
                    "satuan"=>$req->input("satuan"),
                    "desc"=>$req->input("desc"),
                    "stok"=>$req->input("stok"),
                    "foto"=>$req->input("foto"),
                ]
            );
    
            // Data yang dibwa saat berhasil
            $mess = ["type"=>"success","text"=>"Data Berhasil disimpan !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal disimpan !!"];
        }
    
        // Redirect
        return redirect('menu')->with($mess);
        } 
    
        function delete(Request $req){
        try {
            Menu::where("id_menu",$req->id)->delete();
            $mess = ["type"=>"success","text"=>"Data Berhasil dihapus !!"];
        } catch(Exception $err){
            $mess = ["type"=>"error","text"=>"Data Gagal dihapus !!"];
        }
        // Redirect
        return redirect('menu')->with($mess);
        
    }
}

