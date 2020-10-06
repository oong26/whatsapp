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
                <form action="{{url('akun/update')}}" method="post">
                    @csrf
                    @foreach ($data as $item)
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" id="nama" class="form-control" value="{{$item['nama']}}">  
                            <small id="nama" style="color:red;" class="ml-2 form-text ">{{$errors->first('nama')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="alamat">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control">{{$item['alamat']}}</textarea>  
                            <small id="alamat" style="color:red;" class="ml-2 form-text ">{{$errors->first('alamat')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control" value="{{$item['email']}}">  
                            <small id="email" style="color:red;" class="ml-2 form-text ">{{$errors->first('email')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" id="username" class="form-control" value="{{$item['username']}}">
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
                                @if($item['level'] == 0)
                                <option value="1">Admin</option>
                                <option value="0" selected>User</option>
                                @else
                                <option value="1" selected>Admin</option>
                                <option value="0">User</option>
                                @endif
                            </select>
                            <small id="level" style="color:red;" class="ml-2 form-text ">{{$errors->first('level')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="status">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control"> 
                                <option value="">Pilih status</option>
                                @if($item['status'] == 0)
                                <option value="1">Aktifkan</option>
                                <option value="0" selected>Nonaktifkan</option>
                                @else
                                <option value="1" selected>Aktifkan</option>
                                <option value="0">Nonaktifkan</option>
                                @endif
                            </select>
                            <small id="status" style="color:red;" class="ml-2 form-text ">{{$errors->first('status')}}</small>
                        </div>
                    </div>
                    @endforeach                    
                    <div class="form-group float-right">
                        <a href="{{url('akun')}}" class="text-decoration-none btn btn-danger">Batal</a>
                        <input type="submit" value="Perbarui" class="btn btn-primary">
                    </div>
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')