<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout | Session Closed</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('dashboard_assets/dist/img/mono_s.png') }}" alt="">
                <span style="font-size: 3em">
                    {{ env('APP_NAME') !== null ? env('APP_NAME') : 'Zaratica' }}
                </span>
            </a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">User</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="{{ asset('dashboard_assets/dist/img/user1-128x128.jpg') }}" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->

            <form class="lockscreen-credentials" action="{{ route('authenticate')}}" method="post">
                @csrf

                <div class="input-group">
                    <input type="password" class="form-control" placeholder="password">

                    <div class="input-group-append">
                         <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-arrow-right text-muted"></i></button>
                    </div>
                </div>
            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Enter your password to retrieve your session
        </div>
        <div class="text-center">
            <a href="{{ route('login')}}">Or sign in as a different user</a>
        </div>
        <div class="lockscreen-footer text-center">
            <strong>Copyright &copy; 2000-2022 &nbsp;<a href="http://zorkif.com">Zorkif.com</a></strong>
            <br>All rights reserved.<b>Version</b> {{ env('APP_VERSION') }}

        </div>

    </div>



    <!-- /.center -->

    <!-- jQuery -->
    <script src="{{ asset('dashboard_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
