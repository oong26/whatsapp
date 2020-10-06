@include('partials.header')
@include('partials.sidebar')
@include('partials.topbar')

     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">{{$title}}</h1>
        @include('sweetalert::alert')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{$title}}</h6>
            </div>
            <div class="card-body">
                <form action="{{url('pasien/store')}}" method="post">
                    @csrf
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="nik">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" name="nik" id="nik" class="form-control">  
                            <small id="nik" style="color:red;" class="ml-2 form-text ">{{$errors->first('nik')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" id="nama" class="form-control">  
                            <small id="nama" style="color:red;" class="ml-2 form-text ">{{$errors->first('nama')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="alamat">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea> 
                            <small id="alamat" style="color:red;" class="ml-2 form-text ">{{$errors->first('alamat')}}</small> 
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="phone">No. telp (+62)</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="85114758xxx">  
                            <small id="phone" style="color:red;" class="ml-2 form-text ">{{$errors->first('phone')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="resep">Resep</label>
                        <div class="col-sm-10">
                            <textarea name="resep" id="resep" cols="40" rows="5" class="form-control"></textarea> 
                            <small id="resep" style="color:red;" class="ml-2 form-text ">{{$errors->first('resep')}}</small> 
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="tgl">Tanggal HPHT</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl" id="tgl" class="form-control">
                            <small id="tgl" style="color:red;" class="ml-2 form-text ">{{$errors->first('tgl')}}</small>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <input type="reset" value="Batal" class="btn btn-danger">
                        <input type="submit" value="Tambah" class="btn btn-primary">
                    </div>
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')