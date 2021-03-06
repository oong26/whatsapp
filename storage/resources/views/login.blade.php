<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$title}}</title>

  <link rel="shortcut icon" href="{{ url('assets/img/icon_pemkab.png')}}" />
  
  <!-- Custom fonts for this template-->
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body >
  @include('sweetalert::alert')
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 10%;">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-4 d-none d-lg-block justify-content-center" style="padding:10px;">
                <img class="bg-login-image" src="{{url('assets/img/tape-labu.png')}}" alt="">
              </div>
              <div class="col-lg-8 p-4 border-left-login">
                <div class="p-3">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form action="login-process" class="user" method="POST">
                    @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="inputUsername" name="username" placeholder="Masukkan Username">
                    <small id="inputUsername" style="color:red;" class="ml-2 form-text ">{{$errors->first('username')}}</small>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="inputPassword" name="password" placeholder="Masukkan Password">
                    <small id="inputPassword" style="color:red;" class="ml-2 form-text ">{{$errors->first('password')}}</small>
                  </div>
                  <input type="submit" class="btn btn-user btn-block" value="Login" style="background-color: #25D366; color:white;">
                </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<!-- Bootstrap core JavaScript-->
<script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
