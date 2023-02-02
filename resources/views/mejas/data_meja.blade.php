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
        <a href="{{ url('meja/form') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> TAMBAH</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>QR Kode Meja</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>                
               @foreach($meja as $rsMeja)
                    <tr>
                        <td>{{ $rsMeja["id_meja"] }}</td>
                        <td> {!! DNS2D::getBarcodeHTML(($rsMeja->kd_meja), 'QRCODE',5,5) !!}</td>
                        <td>{{ $rsMeja["kapasitas"] }}</td>
                        <td>
                            <?php
                            if($rsMeja["status"]=="Kosong"){
                            ?>
                                <span class="badge bg-success" style="text-align: center">Kosong</span>
                            <?php } 
                            else { 
                            ?>
                                <span class="badge bg-danger" style="text-align: center">Terisi</span>
                            <?php 
                                }
                            ?>
                        </td>                     
                        <td>
                            <a href="{{ url('meja/form/'.$rsMeja["id_meja"]) }}" class="btn btn-warning btn-flat btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{ url('meja/delete/'.$rsMeja["id_meja"]) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
</div>
@endsection 