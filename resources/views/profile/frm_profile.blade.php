@extends('layouts.template')

@section("title","Profile")

@section("page_title","Profile")

@section('content') 
<script>
  $(function(){
      @if(session("type"))
          showMessage('{{ session("type") }}','{{ session("text") }}');
      @endif
  });
</script>
      <!-- Main content -->
      <section class="content">
          <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-4">
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    @if(Auth::user()->foto!="")
                      <img class="profile-user-img img-fluid img-circle" src="{{ Auth::user()->foto }}" class="img-circle elevation-2" alt="User Image">
                    @else
                      <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                  </div>
                  <h3 class="profile-username text-center">{{$user->name}}</h3>
  
                  <p class="text-muted text-center">{{$user->role}}</p>

                 <div class="text-center">
                    <?php
                    if($user["status"]==1){
                  ?>
                    <span class="badge bg-success text-center">Aktif</span>
                  <?php } 
                    else { 
                  ?>
                    <span class="badge bg-danger text-center">Non Aktif</span>
                  <?php 
                    }
                  ?>
                 </div>

                </div>
                <!-- /.card-body --> 
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-5">
              <div class="card">
                  <div class="card-body">
                      <form action="{{ url('profile/save') }}" method="post">
                        @csrf
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                          <input type="text" class="form-control @error("name") is-invalid  @enderror" id="name" name="name" placeholder="Nama" value="{{ old("name") ? old("name") : Auth::user()->name }}">
                          @error("name")
                          <span id="error-name" class="error invalid-feedback">
                              {{ $errors->first("name") }}
                          </span>
                          @enderror
                      </div>                     
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control @error("email") is-invalid  @enderror" id="email" name="email" placeholder="Email" value="{{ old("email") ? old("email") : Auth::user()->email }}">
                          @error("email")
                          <span id="error-email" class="error invalid-feedback">
                              {{ $errors->first("email") }}
                          </span>
                          @enderror
                      </div>                        
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="hidden" name="old_password" value="{{ Auth::user()->password }}">
                          <input type="password" class="form-control @error("password") is-invalid  @enderror" id="password" name="password" placeholder="*****" value="{{ old("password") }}">
                          @error("password")
                          <span id="error-password" class="error invalid-feedback">
                              {{ $errors->first("password") }}
                          </span>
                          @enderror
                      </div>                        
                        <div class="form-group text-right">
                          <button type="submit" class="btn btn-flat btn-lg btn-primary w-5">SIMPAN</button>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
          <div class="col-md-2">

          </div>
      </section>
      <!-- /.content -->

@endsection