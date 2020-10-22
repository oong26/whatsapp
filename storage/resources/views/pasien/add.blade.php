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
                            <input type="text" name="nik" id="nik" class="form-control" value="{{old('nik')}}">  
                            <small id="nik" style="color:red;" class="ml-2 form-text">{{$errors->first('nik')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="kis">KIS</label>
                        <div class="col-sm-10">
                            <input type="text" name="kis" id="kis" class="form-control" value="{{old('kis')}}">  
                            <small id="kis" style="color:red;" class="ml-2 form-text">{{$errors->first('kis')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" id="nama" class="form-control" value="{{old('nama')}}">  
                            <small id="nama" style="color:red;" class="ml-2 form-text">{{$errors->first('nama')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="alamat">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control">{{old('alamat')}}</textarea> 
                            <small id="alamat" style="color:red;" class="ml-2 form-text ">{{$errors->first('alamat')}}</small> 
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="phone">No. telp (+62)</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="85114758xxx" value="{{old('phone')}}">  
                            <small id="phone" style="color:red;" class="ml-2 form-text ">{{$errors->first('phone')}}</small>
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="resep">Pesan</label>
                        <div class="col-sm-10">
                            <textarea name="resep" id="resep" cols="40" rows="5" class="form-control">{{old('resep')}}</textarea> 
                            <small id="resep" style="color:red;" class="ml-2 form-text ">{{$errors->first('resep')}}</small> 
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="tgl">Tanggal HPHT</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl" id="tgl" class="form-control" value="{{old('tgl')}}">
                            <small id="tgl" style="color:red;" class="ml-2 form-text ">{{$errors->first('tgl')}}</small>
                        </div>
                    </div>
                     <div class="form-group row ml-2">
                        <label class="col-sm-2" for="kondisi">Kondisi</label>
                        <div class="col-sm-10">
                            <select name="kondisi" id="kondisi" class="form-control">
                                <option value="">Pilih status</option>
                                <option value="Merah">Merah</option>
                                <option value="Kuning">Kuning</option>
                                <option value="Hijau">Hijau</option>
                            </select>
                            <small id="kondisi" style="color:red;" class="ml-2 form-text ">{{$errors->first('kondisi')}}</small>
                        </div>
                    </div>
                    @if (!(Session::get('nama_level') == 'Super Admin' || Session::get('nama_level') == 'Admin'))
                    {{-- user = bidan --}}
                    @else
                    {{-- user = super admin atau admin --}}
                    <div class="form-group row ml-2">
                        <label class="col-sm-2" for="desa">Desa</label>
                        <div class="col-sm-10">
                            <select name="desa" id="desa" class="form-control">
                                <option value="">Pilih desa</option>
                                @foreach ($desa as $item)
                                <option value="{{$item['id_desa']}}">{{$item['desa']}}</option>
                                @endforeach
                            </select>
                            <small id="desa" style="color:red;" class="ml-2 form-text ">{{$errors->first('tgl')}}</small>
                        </div>
                    </div>
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
                    <div class="form-group float-right">
                        <a class="text-decoration-none" href="{{url('pasien')}}">
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