@include('partials.header')
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #25D366;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="{{url('assets/img/icon_pemkab.png')}}" alt="" style="width: 40px;height:40px;">
      </div>
      <div class="sidebar-brand-text mx-3">Tape Labu</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{url('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
@include('partials.topbar')

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Pesan Terkirim</h1>
          {{-- <a href="{{url('akun/tambah')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a> --}}
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesan Terkirim</h6>
                </div>
                <div class="card-body">
                    <h4>
                        Berhasil terkirim. Silahkan tutup halaman ini.
                        {{-- <button type="button" class="btn btn-outline-danger" onclick="windowClose()">Tutup</button> --}}
                    </h4>
                </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

@include('partials.footer')