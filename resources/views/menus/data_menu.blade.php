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
        <a href="{{ url('menu/form') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> TAMBAH</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover data">
            <thead>
                <tr>
                    <th>QR Kode Menu</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Dapur</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>                
               @foreach($menu as $rsMenu)
                    <tr>
                        <td> {!! DNS2D::getBarcodeHTML(($rsMenu->kd_menu), 'QRCODE',5,5) !!} </td>
                        <td>
                            @if($rsMenu["foto"]!="")
                                <img class="avatar" src="{{ $rsMenu["foto"] }}" alt="">
                            @else
                                <img class="avatar" src="{{ asset('images/no-images.jpg') }}" alt="">
                            @endif
                        </td>
                        <td>{{ $rsMenu["nm_menu"] }}</td>
                        <td>{{ $rsMenu["kategori"] }}</td>                     
                        <td>{{ number_format($rsMenu["harga"],"0",",",".") }} / {{ $rsMenu["satuan"] }}</td>
                        
                        <td>{{ $rsMenu["dapur"] }}                  
                        <td>
                            <?php
                            if($rsMenu["stok"]=="Available"){
                            ?>
                                <span class="badge bg-success" style="text-align: center">Available</span>
                            <?php } 
                            else { 
                            ?>
                                <span class="badge bg-danger" style="text-align: center">Not Available</span>
                            <?php 
                                }
                            ?>
                        </td>
                        <td>
                            <a href="{{ url('menu/form/'.$rsMenu["id_menu"]) }}" class="btn btn-warning btn-flat btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{ url('menu/delete/'.$rsMenu["id_menu"]) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
</div>
@endsection 