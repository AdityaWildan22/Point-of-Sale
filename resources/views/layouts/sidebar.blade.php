<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/')}}" class="brand-link">
      <img src="{{ asset('images/logo_atas.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SENJA CAFE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->foto!="")
          <img src="{{ Auth::user()->foto }}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a class="d-block">{{Auth::user()->name}} ( {{Auth::user()->role}} )</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li> --}}
          <li class="nav-header">DATA MASTER</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Member
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('member') }}" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Data Member</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('member/form') }}" class="nav-link">
                    <i class="fas fa-user-plus nav-icon"></i>
                    <p>Tambah Member</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                  Menu
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('menu') }}" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Data Menu</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('menu/form') }}" class="nav-link">
                    {{-- <i class="nav-icon fas fa-burger-glass"></i> --}}
                    <i class="nav-icon fas fa-utensils"></i>
                    <p>Tambah Menu</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Meja
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('meja') }}" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Data Meja</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('meja/form') }}" class="nav-link">
                    <i class="fas fa-table nav-icon"></i>
                    <p>Tambah Meja</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">TRANSAKSI</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('transaksi') }}" class="nav-link">
                    <i class="fas fa-wallet nav-icon"></i>
                    <p>Data Transaksi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('transaksi/form') }}" class="nav-link">
                    <i class="fas fa-money-bill nav-icon"></i>
                    <p>Tambah Transaksi</p>
                  </a>
                </li>
              </ul>
            </li> 
          <li class="nav-header">REPORTS</li>
          <li class="nav-item">
            <a href="{{ url('reports/cetak/transaksi')}}" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('reports/transaksi') }}" class="nav-link" target= "blank">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Laporan Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('reports/member') }}" class="nav-link" target= "blank">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Laporan Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('reports/menu') }}" class="nav-link" target= "blank">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Laporan Menu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">SETTINGS</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('user') }}" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Data User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('user/form') }}" class="nav-link">
                    <i class="fas fa-user-plus nav-icon"></i>
                    <p>Tambah User</p>
                  </a>
                </li>
              </ul>
            </li> 
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Logout
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                      onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                      <i class="far fa-circle nav-icon"></i>
                      {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>
                </li>
              </ul>
            </li>  --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>