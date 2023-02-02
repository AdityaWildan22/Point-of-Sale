@extends('layouts.template')

@section("title",$title)
@section("page_title",$page_title)

@section('content')
    <script>
        $(function(){
            @if($errors->any())
                showMessage("error", "Terjadi Kesalahan !");
                @error("file")
                showMessage("error", '{{ $errors->first("file") }}');
                @enderror
            @endif
        });
    </script>
    <form action="{{ url('menu/save') }}" method="post" enctype="multipart/form-data">
        @csrf {{-- Token Keamanan --}}
        <div class="row">
            <div class="dt_foto col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img id="avatar" src="{{ @$rsMenu->foto != "" ? $rsMenu->foto : asset('images/no-images.jpg')}}" alt="">
                        <input type="file" class="file" name="file" id="file" style="display:none" value="{{ old("file") ? old("file") : @$rsMenu->file}}">
                        <textarea name="foto" id="foto" cols="30" rows="10" style="display:none">{{  @$rsMenu->foto }}</textarea>
                    </div>
                </div>                
            </div>
            <div class="dt_menu col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kd_menu">Kode Menu</label>
                            <input type="hidden" name="id_menu" value="{{ @$rsMenu->id_menu }}">
                            <input type="text" class="form-control @error("kd_menu") is-invalid  @enderror" id="kd_menu" name="kd_menu" placeholder="Kode Menu" value="{{ old("kd_menu") ? old("kd_menu") : @$rsMenu->kd_menu }}">
                            @error("kd_menu")
                            <span id="error-kd_menu" class="error invalid-feedback">
                                {{ $errors->first("kd_menu") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nm_menu">Nama Menu</label>
                            <input type="text" class="form-control @error("nm_menu") is-invalid  @enderror" id="nm_menu" name="nm_menu" placeholder="Nama Menu" value="{{ old("nm_menu") ? old("nm_menu") : @$rsMenu->nm_menu }}">
                            @error("nm_menu")
                            <span id="error-nm_menu" class="error invalid-feedback">
                                {{ $errors->first("nm_menu") }}
                            </span>
                            @enderror
                        </div>                        
                        <div class="form-group">
                            <label for="kategori">Jenis kategori</label>
                            <select class="custom-select rounded-0 @error("kategori") is-invalid  @enderror" id="kategori" name="kategori">
                                <option value="" selected="true" disabled="disabled">- Pilih kategori -</option>
                                <option {{ @$rsMenu->kategori == "Makanan" ? "selected" : "" }} value="Makanan">Makanan</option>
                                <option {{ @$rsMenu->kategori == "Minuman" ? "selected" : "" }} value="Minuman">Minuman</option>
                                <option {{ @$rsMenu->kategori == "Snack" ? "selected" : "" }} value="Snack">Snack</option>
                            </select>
                            @error("kategori")
                            <span id="error-kategori" class="error invalid-feedback">
                                {{ $errors->first("kategori") ? old("kategori") : @$rsMenu->kategori }}
                            </span>
                            @enderror                            
                        </div>                       
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="harga" class="form-control @error("harga") is-invalid  @enderror" id="harga" name="harga" placeholder="Harga" value="{{ old("harga") ? old("harga") : @$rsMenu->harga }}">
                            @error("harga")
                            <span id="error-harga" class="error invalid-feedback">
                                {{ $errors->first("harga") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control @error("satuan") is-invalid  @enderror" id="satuan" name="satuan" placeholder="Satuan" value="{{ old("satuan") ? old("satuan") : @$rsMenu->satuan }}">
                            @error("satuan")
                            <span id="error-satuan" class="error invalid-feedback">
                                {{ $errors->first("satuan") }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desc">Deskripsi</label>
                            <input type="desc" class="form-control @error("desc") is-invalid  @enderror" id="desc" name="desc" placeholder="Deskripsi" value="{{ old("desc") ? old("desc") : @$rsMenu->desc}}">
                            @error("desc")
                            <span id="error-desc" class="error invalid-feedback">
                                {{ $errors->first("desc") }}
                            </span>
                            @enderror
                        </div>                         
                        <div class="form-group">
                            <label for="dapur">Jenis Dapur</label>
                            <select class="custom-select rounded-0 @error("dapur") is-invalid  @enderror" id="dapur" name="dapur">
                                <option value="" selected="true" disabled="disabled">- Pilih Dapur -</option>
                                <option {{ @$rsMenu->dapur == "Makanan" ? "selected" : "" }} value="Makanan">Makanan</option>
                                <option {{ @$rsMenu->dapur == "Minuman" ? "selected" : "" }} value="Minuman">Minuman</option>
                                <option {{ @$rsMenu->dapur == "Snack" ? "selected" : "" }} value="Snack">Snack</option>
                            </select>
                            @error("dapur")
                            <span id="error-dapur" class="error invalid-feedback">
                                {{ $errors->first("dapur") ? old("dapur") : @$rsMenu->dapur }}
                            </span>
                            @enderror                            
                        </div>
                        <div class="form-group">
                            <label for="stok">Status</label>
                            <select class="custom-select rounded-0 @error("stok") is-invalid  @enderror" id="stok" name="stok">
                                <option value="" selected="true" disabled="disabled">- Pilih Status -</option>
                                <option {{ @$rsMenu->stok == "Available" ? "selected" : "" }} value="Available">Available</option>
                                <option {{ @$rsMenu->stok == "Not Available" ? "selected" : "" }} value="Not Available">Not Available</option>
                            </select>
                            @error("stok")
                            <span id="error-stok" class="error invalid-feedback">
                                {{ $errors->first("stok") ? old("stok") : @$rsMenu->stok }}
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
            </div>
        </div>
    </form>
@endsection 