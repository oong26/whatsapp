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
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No.telp.</th>
                    <th>Resep</th>
                    <th>Tanggal HPHT</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <th>#</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No.telp.</th>
                  <th>Resep</th>
                  <th>Tanggal HPHT</th>
                  <th>Aksi</th>
                </tfoot>
                <tbody>
                  @foreach ($data as $item)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item['nik']}}</td>
                        <td>{{$item['nama']}}</td>
                        <td>{{$item['alamat']}}</td>
                        <td>{{$item['phone']}}</td>
                        <td>{{substr($item['resep'], 0 , 100)}}...</td>
                        <td>{{substr($item['tgl_hpht'], 0, 10)}}</td>
                        <td>
                          <a href="{{url('pasien/edit/'.$item->id)}}"> <span class="fa fa-pen" style="color:#4e73df;"></span></a>
                          <a href="{{url('pasien/delete/'.$item->id)}}"> <span class="fa fa-trash" style="color:#e74a3b;"></span></a>
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