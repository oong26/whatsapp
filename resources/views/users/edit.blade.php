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
                        <label for="nama">Nama</label>
                        <div class="col-sm-6">
                            <input type="text" name="nama" id="nama" class="form-control" value="{{$item['nama']}}">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control">{{$item['alamat']}}</textarea>  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control ml-2" value="{{$item['email']}}">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{$item['username']}}">
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
                                @if($item['level'] == 0)
                                <option value="1">Admin</option>
                                <option value="0" selected>User</option>
                                @else
                                <option value="1" selected>Admin</option>
                                <option value="0">User</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="status">Status</label>
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
                        </div>
                    </div>
                    @endforeach
                    <a href="{{url('akun')}}" class="text-decoration-none btn btn-danger">Batal</a>
                    <input type="submit" value="Perbarui" class="btn btn-primary">
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')