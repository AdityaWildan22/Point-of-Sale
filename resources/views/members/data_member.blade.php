@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
<script>
    $(function(){
        @if(session("type"))
            showMessage('{{ session("type") }}','{{ session("text") }}');
        @endif
    });
</script>
<div class="card">
    <div class="card-header">
        <div class="card-title">
         <a href="{{ url('member/form') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> TAMBAH</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover data">
            <thead>
            <tr>
                <th style="width: 10px">Foto</th>
                <th>QR Kode Member</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($members as $rsMember)
                  <tr>
                    <td>
                        @if($rsMember["foto"]!="")
                            <img class="avatar" src="{{ $rsMember["foto"] }}" alt="">
                        @else
                            <img class="avatar" src="{{ asset("images/no-images.jpg") }}" alt="">
                        @endif
                    </td>
                        <td> {!! DNS2D::getBarcodeHTML(($rsMember->kd_member), 'QRCODE',5,5) !!}</td>
                        <td>{{ $rsMember["nm_member"] }}</td>
                        <td>{{ $rsMember["alamat"]." ". $rsMember["kota"] }}
                        <br/>
                        Telp : {{ $rsMember["telp"] }}
                        </td>
                        {{-- <td>{{ $rsMember["foto"] }}</td> --}}
                        <td>{{ $rsMember["jk"]==1 ? "Laki-laki" : "Perempuan" }}</td>
                        <td>
                            <?php
                            if($rsMember["status"]==1){
                            ?>
                                <span class="badge bg-success" style="text-align: center">Aktif</span>
                            <?php } 
                            else { 
                            ?>
                                <span class="badge bg-danger" style="text-align: center">Non Aktif</span>
                            <?php 
                                }
                            ?>
                        </td>
                        <td>
                            <a href="{{ url('member/form/'.$rsMember["id_member"]) }}" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ url('member/delete/'.$rsMember["id_member"]) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i></a>
                            <a href="{{ url('member/card/'.$rsMember["id_member"]) }}" class="btn btn-success btn-flat btn-sm"><i class="fa fa-print"></i></a>
                        </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>     
@endsection