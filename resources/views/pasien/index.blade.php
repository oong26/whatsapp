@include('partials.header')
@include('partials.sidebar')
@include('partials.topbar')

      <!-- Begin Page Content -->
      <div class="container-fluid">

      <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
            <a href="{{url('pasien/tambah')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
          </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- DataTables -->
         <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien({{count($data)}})</h6>
            <a href="{{url('pasien/export')}}" class="float-right d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Excel</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">No.telp.</th>
                    <th class="text-center">Resep</th>
                    <th class="text-center">Tanggal HPHT</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <th class="text-center">#</th>
                  <th class="text-center">NIK</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">No.telp.</th>
                  <th class="text-center">Resep</th>
                  <th class="text-center">Tanggal HPHT</th>
                  <th class="text-center">Aksi</th>
                </tfoot>
                <tbody>
                  @foreach ($data as $item)
                      <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center">{{$item['nik']}}</td>
                        <td class="text-center">{{$item['nama']}}</td>
                        <td class="text-center">{{$item['alamat']}}</td>
                        <td class="text-center">{{$item['phone']}}</td>
                        <td class="text-center">{{substr($item['resep'], 0 , 100)}}...</td>
                        <td class="text-center">{{substr($item['tgl_hpht'], 0, 10)}}</td>
                        <td class="text-center">
                          <a class="m-1" href="{{url('pasien/edit/'.$item->id)}}"> <span class="fa fa-pen" style="color:#4e73df;"></span></a>
                          <a class="m-1" href="{{url('pasien/delete/'.$item->id)}}"> <span class="fa fa-trash" style="color:#e74a3b;"></span></a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>

      </div>
      <!-- /.container-fluid -->

@include('partials.footer')