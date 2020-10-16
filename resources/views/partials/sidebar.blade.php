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
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if (Session::get('nama_level') == 'Super Admin')
    {{-- jika admin --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user-md"></i>
        <span>Akun</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Akun</h6>
          <a class="collapse-item" href="{{url('akun')}}">Lihat</a>
          <a class="collapse-item" href="{{url('akun/tambah')}}">Tambah</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-female"></i>
        <span>Pasien</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pasien Ibu hamil</h6>
          <a class="collapse-item" href="{{url('pasien')}}">Lihat</a>
          <a class="collapse-item" href="{{url('pasien/tambah')}}">Tambah</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesLevel" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-cog"></i>
        <span>Wewenang</span>
      </a>
      <div id="collapseUtilitiesLevel" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Wewenang</h6>
          <a class="collapse-item" href="{{url('wewenang')}}">Lihat</a>
          <a class="collapse-item" href="{{url('wewenang/tambah')}}">Tambah</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{url('artikel')}}">
        <i class="fas fa-fw fa-file"></i>
        <span>Artikel</span></a>
    </li>
    @elseif(Session::get('nama_level') == 'Admin')
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user-md"></i>
        <span>Akun</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Akun</h6>
          <a class="collapse-item" href="{{url('akun')}}">Lihat</a>
          <a class="collapse-item" href="{{url('akun/tambah')}}">Tambah</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-female"></i>
        <span>Pasien</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pasien Ibu hamil</h6>
          <a class="collapse-item" href="{{url('pasien')}}">Lihat</a>
          <a class="collapse-item" href="{{url('pasien/tambah')}}">Tambah</a>
        </div>
      </div>
    </li>
    @else
    {{-- jika bidan --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-female"></i>
        <span>Pasien</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pasien Ibu hamil</h6>
          <a class="collapse-item" href="{{url('pasien')}}">Lihat</a>
          <a class="collapse-item" href="{{url('pasien/tambah')}}">Tambah</a>
        </div>
      </div>
    </li>
    @endif

    @if (Session::get('nama_level') == 'Super Admin')
    {{-- jika admin --}}
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Lainnya
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWA" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-phone-alt"></i>
        <span>WhatsApp</span>
      </a>
      <div id="collapseWA" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pengaturan WhatsApp</h6>
          <a class="collapse-item" href="http://localhost:8000/" target="_blank">Server</a>
          <a class="collapse-item" href="{{url('waktu')}}">Waktu penjadwalan</a>
        </div>
      </div>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->