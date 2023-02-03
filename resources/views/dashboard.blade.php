@extends('layouts.template')

@section("title","Dashboard")
@section ("page_title","Dashboard")

@section('content') 
    <div class="text-center" style="color: black">
        <h5><strong>SENJA CAFE</strong></h3>
        <p><strong>Jalan Kelapa Manis No.12 Madiun</strong></p>
    </div>
    {{-- <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_member }}</h3>
                    <p>Total Member</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ url("member")}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_menu }}</h3>
                    <p>Total Menu</p>
                </div>
                <div class="icon">
                    <i class="icon ion-pizza"></i>
                    {{-- <i class="icon ion-beer"></i> --}}
                {{-- </div>
                <a href= "{{ url("menu")}}" class="small-box-footer" >More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_transaksi }}</h3>
                    <p>Total Transaksi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-cart"></i>
                </div>
                <a href="{{ url("transaksi")}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </div> --}}
   <div class="row">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Member</span>
                <span class="info-box-number">
                    {{ $total_member }}
                </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-4 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-utensils"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Menu</span>
                <span class="info-box-number">{{ $total_menu }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi</span>
                <span class="info-box-number">{{ $total_transaksi }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total User</span>
                <span class="info-box-number">{{ $total_user }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
   </div>
   <h3>Pendapatan</h3>
    <div class="row">
        <div class="col-md-1">
            
        </div>
        {{-- <div class="col-md-2">
            
        </div>
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp {{ number_format($revenue->total,"0",",",".") }}</h3>
                    <p>Pendapatan Per Bulan</p>
                </div>
                <div class="icon">
                    <i class="icon ion-cash"></i>
                </div>
                <a href="{{ url("reports/transaksi")}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp {{ number_format($rev_week,"0",",",".") }}</h3>
                    <p>Pendapatan Per Minggu</p>
                </div>
                <div class="icon">
                    <i class="icon ion-cash"></i>
                </div>
                <a href="{{ url("reports/transaksi")}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp {{ number_format($rev_day->total,"0",",",".") }}</h3>
                    <p>Pendapatan Per Hari</p>
                </div>
                <div class="icon">
                    <i class="icon ion-cash"></i>
                </div>
                <a href="{{ url("reports/transaksi")}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>  --}}
        <div class="col-12 col-sm-4 col-md-3">
            <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pendapatan Per Tahun</span>
                <span class="info-box-number">
                    Rp {{ number_format($rev_year->total,"0",",",".") }}
                </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-4 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan Per Bulan</span>
                <span class="info-box-number">  Rp {{ number_format($rev_month->total,"0",",",".") }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        {{-- <div class="col-12 col-sm-4 col-md-3">
            <div class="info-box mb-6">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan Per Minggu</span>
                <span class="info-box-number">Rp {{ number_format($rev_week,"0",",",".") }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div> --}}
        <div class="col-12 col-sm-4 col-md-3">
            <div class="info-box mb-6">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan Per Hari</span>
                <span class="info-box-number">Rp {{ number_format($rev_day->total,"0",",",".") }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@endsection