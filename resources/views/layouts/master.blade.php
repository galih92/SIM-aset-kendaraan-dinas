<!doctype html>
<html lang="en">

<head>
  <title>DLHKP Kediri</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- VENDOR CSS -->


  <link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{url('css/datatables.bootstrap.css')}}">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
  @yield('styles')
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- NAVBAR -->
    @include('layouts.includes._navbar')
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    @include('layouts.includes._sidebar')
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    @yield('content')
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
      <div class="container-fluid">
        <p class="copyright">&copy; 2017 <a href="https://api.whatsapp.com/send?phone=6289639168431&text=Halo%20Admin%20informasi%20website" target="_blank">More Information</a>. Galih Dwi P.</p>
      </div>
    </footer>
  </div>
  <!-- END WRAPPER -->
  <!-- Javascript -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('admin/assets/scripts/klorofil-common.js')}}"></script>
  <script src="{{url('js/jquery.dataTables.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  @include('sweetalert::alert')
  @yield('footer')
</body>

</html>
