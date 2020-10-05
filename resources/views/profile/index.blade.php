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
                <form action="{{url('profil/update')}}" method="post">
                    @csrf
                    @foreach($data as $item)
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
                    {{-- <div class="form-group">
                        <div class="form-inline">
                            <label class="mr-xl-5" for="ket">Keterangan</label>
                            <textarea name="ket" id="ket" cols="30" rows="5" class="form-control"></textarea>  
                        </div>
                    </div> --}}
                    @endforeach
                    <a class="text-decoration-none btn btn-danger" href="{{url('dashboard')}}">Batal</a>
                    <input type="submit" value="Perbarui" class="btn btn-primary">
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')