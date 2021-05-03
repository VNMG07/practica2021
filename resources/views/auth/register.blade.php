@extends('base')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{route('dashboard')}}"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{url('user/register')}}" method="post" enctype="multipart/form-data">
         @csrf
         @if(Session::has('success'))
                           <div class="alert alert-success alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               {{Session::get('success')}}
                           </div>
                       @elseif(Session::has('failed'))
                           <div class="alert alert-danger alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               {{Session::get('failed')}}
                           </div>
                       @endif
                       @if ($errors->has('name'))
                           <div class="alert alert-danger">{{$errors->first('name')}}</div> @endif
        <div class="input-group mb-3">
           <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}" />

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('email'))
            <div class="alert alert-danger">{{$errors->first('email')}}</div> @endif
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email')}}" >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>


        @if ($errors->has('avatar'))
            <div class="alert alert-danger">{{$errors->first('avatar')}}</div> @endif
        <div class="input-group mb-3">
          <input type="file" name="avatar" class="form-control" placeholder="Avatar" value="{{old('avatar')}}" >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('password'))
            <div class="alert alert-danger">{{$errors->first('password')}}</div> @endif
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="{{route('login')}}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
@endsection
</body>
</html>
