@include('partials.header')
    <div class="container">
        <div class="row">
            <div class="col mt-5">
               <form action="store" method="post">
                   @csrf
                   <h2>Tambah User</h2>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                       <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Telp.</label>
                       <input type="text" class="form-control" name="phone" id="phone" placeholder="Nomor telepon">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Tambah">
               </form>
            </div>
        </div>
    </div>
@include('partials.footer')