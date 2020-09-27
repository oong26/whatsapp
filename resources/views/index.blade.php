@include('partials.header')
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <a href="{{ url('user/add') }}">
                    <button class="btn btn-primary">Tambah User</button>
                </a>
                {{-- <a href="{{ url('msg') }}">
                    <button class="btn btn-success">Kirim pesan</button>
                </a> --}}
                <form action="msg/send" method="post">
                    @csrf
                    <input type="submit" class="btn btn-success" value="Kirim">
                </form>
            </div>
        </div>
    </div>
@include('partials.footer')