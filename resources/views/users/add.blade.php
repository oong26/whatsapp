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
                <form action="{{url('akun/store')}}" method="post">
                    @csrf
                    <div class="form-group row ml-2">
                        <label for="nama">Nama</label>
                        <div class="col-sm-6">
                            <input type="text" name="nama" id="nama" class="form-control">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control ml-2">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="username">Username</label>
                            <input type="text" name="username" id="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="level">Wewenang</label>
                            <select name="level" id="level" class="form-control"> 
                                <option value="">Pilih wewenang</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                    <input type="reset" value="Batal" class="btn btn-danger">
                    <input type="submit" value="Tambah" class="btn btn-success">
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')