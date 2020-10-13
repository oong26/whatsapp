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
                <form action="{{url('pasien/update')}}" method="post">
                    @csrf
                    @foreach ($data as $item)
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="nik">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" name="nik" id="nik" class="form-control" value="{{$item['nik']}}">
                            <small id="nik" style="color:red;" class="ml-2 form-text ">{{$errors->first('nik')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="kis">KIS</label>
                        <div class="col-sm-10">
                            <input type="text" name="kis" id="kis" class="form-control" value="{{$item['kis']}}">  
                            <small id="kis" style="color:red;" class="ml-2 form-text">{{$errors->first('kis')}}</small>
                        </div>
                    </div>
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
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"> {{$item['alamat']}}</textarea>
                            <small id="alamat" style="color:red;" class="ml-2 form-text ">{{$errors->first('alamat')}}</small>  
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="phone">No. telp (+62)</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="85114758xxx" value="{{substr($item['phone'], 2)}}">
                            <small id="phone" style="color:red;" class="ml-2 form-text ">{{$errors->first('phone')}}</small>  
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="resep">Resep</label>
                        <div class="col-sm-10">
                            <textarea name="resep" id="resep" cols="40" rows="5" class="form-control">{{$item['resep']}}</textarea>
                            <small id="resep" style="color:red;" class="ml-2 form-text ">{{$errors->first('resep')}}</small>  
                        </div>
                    </div>
                    @if (!(Session::get('nama_level') == 'Super Admin' || Session::get('nama_level') == 'Admin'))
                    {{-- user = bidan --}}
                    @else
                    {{-- user = super admin atau admin --}}
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="bidan">Bidan</label>
                        <div class="col-sm-10">
                            <select name="bidan" id="bidan" class="form-control">
                                <option value="">Pilih bidan</option>
                                @foreach ($bidan as $item)
                                    <option value="{{$item->id}}">{{$item->nama}} - {{$item->wilayah}}</option>
                                @endforeach
                            </select>
                            <small id="bidan" style="color:red;" class="ml-2 form-text ">{{$errors->first('bidan')}}</small>
                        </div>
                    </div>
                    @endif
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
                        <a class="text-decoration-none btn btn-danger" href="{{url('pasien')}}">Batal</a>
                        <input type="submit" value="Perbarui" class="btn btn-primary">
                    </div>
                </form>
            </div>
          </div>
        

    </div>
    <!-- /.container-fluid -->

@include('partials.footer')