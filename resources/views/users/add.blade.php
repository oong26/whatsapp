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
                        <label class="col-sm-2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control">  
                            <small id="email" style="color:red;" class="ml-2 form-text ">{{$errors->first('email')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" id="username" class="form-control">
                            <small id="username" style="color:red;" class="ml-2 form-text ">{{$errors->first('username')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="password">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" id="password" class="form-control">
                            <small id="password" style="color:red;" class="ml-2 form-text ">{{$errors->first('password')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="level">Wewenang</label>
                        <div class="col-sm-10">
                            <select name="level" id="level" class="form-control"> 
                                <option value="">Pilih wewenang</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                            <small id="level" style="color:red;" class="ml-2 form-text ">{{$errors->first('level')}}</small>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <a class="text-decoration-none" href="{{url('akun')}}">
                            <input class="btn btn-danger" type="button" value="Batal">
                        </a>
                        <input type="submit" value="Tambah" class="btn btn-primary">
                    </div>
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')