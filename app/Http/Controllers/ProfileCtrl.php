<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileCtrl extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    function index(){
        $data = [
            "title" => "Profile",
            "page_title" => "Profile",
            "user" => User::where("id",Auth::user()->id)->first()
        ];

        return view("profile.frm_profile",$data);
    }

    function update(Request $req){
        try{
            User::where("id",$req->input("id"))->update([
                "name"=>$req->input("name"),
                "email"=>$req->input("email"),
                "password"=> $req->input("password") == "" ? $req->input("old_password") : Hash::make($req->input("password")),
            ]);
            $mess = ["type"=>"success","text"=>"Data Berhasil disimpan !!"];
        }catch (Exception $err){
            $mess = ["type"=>"danger","text"=>"Data Gagal disimpan !!"];
        }
          // Redirect
          return redirect('profile');
    }
    
}
