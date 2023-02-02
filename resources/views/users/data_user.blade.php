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
        <a href="{{ url('user/form') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> TAMBAH</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover data">
            <thead>
                <tr>
                    <th style="width: 10px">Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>                
               @foreach($users as $rsUser)
                    <tr>
                        <td>
                            @if($rsUser["foto"]!="")
                                <img class="avatar" src="{{ $rsUser["foto"] }}" alt="">
                            @else
                                <img class="avatar" src="{{ asset("images/no-images.jpg") }}" alt="">
                            @endif
                        </td>
                        <td>{{ $rsUser["name"] }}</td>
                        <td>{{ $rsUser["email"] }}</td>                     
                        <td>{{ $rsUser["role"] }}</td>                     
                        <td>
                            <?php
                            if($rsUser["status"]==1){
                            ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php } 
                            else { 
                            ?>
                                <span class="badge bg-danger">Non Aktif</span>
                            <?php 
                                }
                            ?>
                        </td>
                        <td>
                            <a href="{{ url('user/form/'.$rsUser["id"]) }}" class="btn btn-warning btn-flat btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{ url('user/delete/'.$rsUser["id"]) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
</div>
@endsection 