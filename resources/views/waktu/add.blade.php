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
                <form action="{{url('waktu/store')}}" method="post">
                    @csrf
                    <div class="form-group row ml-2">
                        <div class="col-6">
                            <label class="col-sm-2" for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="{{old('judul')}}">  
                            <small id="judul" style="color:red;" class="ml-2 form-text">{{$errors->first('judul')}}</small>
                        </div>
                        <div class="col-6">
                            <label class="col-sm-2" for="jam">Jam</label>
                            <input type="time" class="form-control" name="jam" id="jam">
                            <small id="jam" style="color:red;" class="ml-2 form-text">{{$errors->first('jam')}}</small>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <a class="text-decoration-none" href="{{url('waktu')}}">
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