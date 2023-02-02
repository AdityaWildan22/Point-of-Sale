@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
    <script>
        $(function(){
            @if($errors->any())
            showMessage("error", "Terjadi Kesalahan !");
            @endif
        });
    </script>
    <form action="{{ url('meja/save') }}" method="post">
        @csrf {{-- Token Keamanan --}}
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="dt_meja col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kd_meja">Kode Meja</label>
                            <input type="hidden" name="id_meja" value="{{ @$rsMeja->id_meja }}">
                            <input type="text" class="form-control @error("kd_meja") is-invalid  @enderror" id="kd_meja" name="kd_meja" placeholder="Kode Meja" value="{{ old("kd_meja") ? old("kd_meja") : @$rsMeja->kd_meja }}">
                            @error("kd_meja")
                            <span id="error-kd_meja" class="error invalid-feedback">
                                {{ $errors->first("kd_meja") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kapasitas">Kapasitas</label>
                            <select class="custom-select rounded-0 @error("kapasitas") is-invalid  @enderror" id="kapasitas" name="kapasitas">
                                <option value="" selected="true" disabled="disabled">- Pilih Kapasitas -</option>
                                <option {{ @$rsMeja->kapasitas == "2 Orang" ? "selected" : "" }} value="1">2 Orang</option>
                                <option {{ @$rsMeja->kapasitas == "4 Orang" ? "selected" : "" }} value="2">4 Orang</option>
                                <option {{ @$rsMeja->kapasitas == "6 Orang" ? "selected" : "" }} value="3">6 Orang</option>
                            </select>
                            @error("kapasitas")
                            <span id="error-kapasitas" class="error invalid-feedback">
                                {{ $errors->first("kapasitas") ? old("kapasitas") : @$rsMeja->kapasitas }}
                            </span>
                            @enderror 
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select rounded-0  @error("status") is-invalid  @enderror" id="status" name="status">
                                <option value="" selected="true" disabled="disabled">- Pilih Status -</option>
                                <option {{ @$rsMember->status =="Kosong" ?"selected" : "" }} value="Kosong">Kosong</option>
                                <option {{ @$rsMember->status =="Terisi" ?"selected" : "" }} value="Terisi">Terisi</option>
                            </select>
                            @error("status")
                                <span id="error-status" class="error invalid-feedback">
                                    {{ $errors->first("status") }}
                                </span>
                            @enderror 
                        </div>                       
                    </div>
                    <div class="card-footer">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary w-25">SIMPAN</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </form>
@endsection 