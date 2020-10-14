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
                <form action="{{url('send-artikel')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="file">Pilih file artikel</label>
                        <div class="col-sm-10">
                            <input type="file" class="file-input" name="file" id="file">
                            <small id="file" style="color:red;" class="ml-2 form-text">{{$errors->first('file')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="pesan">Pesan(Opsional)</label>
                        <div class="col-sm-10">
                            <textarea name="pesan" id="pesan" cols="30" rows="5" class="form-control">{{old('pesan')}}</textarea> 
                            <small id="pesan" style="color:red;" class="ml-2 form-text ">{{$errors->first('pesan')}}</small> 
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <a class="text-decoration-none" href="{{url('/')}}">
                            <input class="btn btn-danger" type="button" value="Batal">
                        </a>
                        <input type="submit" value="Kirim" class="btn btn-primary">
                    </div>
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')