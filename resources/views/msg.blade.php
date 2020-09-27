@include('partials.header')
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <form action="msg/send" method="post">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="no">No Tujuan</label>
                        <input type="text" class="form-control" name="no" id="no" placeholder="No tujuan">
                    </div>
                    <div class="form-group">
                        <label for="msg">Pesan</label>
                        <br>
                        <textarea name="msg" class="form-control" id="msg" cols="100" rows="5"></textarea>
                    </div> --}}
                    <input type="submit" class="btn btn-success" value="Kirim">
                </form>
            </div>
        </div>
    </div>
@include('partials.footer')