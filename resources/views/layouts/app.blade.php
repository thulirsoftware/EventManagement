
<!DOCTYPE html>
<html style="height: 100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TAGDV') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/login/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/timepicker.css') }}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Include the plugin's CSS and JS: -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>

    <style>
        .nav-link{
            color:white;
        }
        .btn-primary
        {
            color: #ffffff !important;
            background-color: #8f3319 !important;
            border-color: #8f3319 !important;
            transition: all 0.4s ease 0s;

        }
        .btn-primary:hover
        {

            color: #8f3319 !important;
            background: white !important;
            border: 2px solid #8f3319 !important;
            display: inline-block;
        }
        .btn-primary:focus
        {
            background-color: #ffffff;
            color:#8f3319;
            border:1px solid #8f3319;
        }
        .btn-primary:visited
        { 
            background-color: #ffffff;
            color:#8f3319;
            border:1px solid #8f3319;
        }
        .btn-back {
            color: #8f3319 !important;
            background-color: #ffffb7 !important;
            border-color: #8f3319 !important;
            transition: all 0.4s ease 0s;
        }
        .btn-back:hover {
            color: #ffffb7 !important;
            background-color: #8f3319 !important;
            border-color: #ffffb7 !important;
            transition: all 0.4s ease 0s;
        }
        .content-wrapper{
            background-color: #FFFFB7;
        }
        .table-borderless{
           border: 1px solid #ddd;
       }
       .table{
          background-color:#ffffcc;
      }
      .card-header{
        background-color:#ffffcc;
        border: 1px solid #ddd;

    }
    .card-title {
        float: left;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }
    .badge
    {
        font-size:15px;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
      padding-top:30px;

  }

  th
  {
      text-align: left;
      border: 1px solid #ddd;
      color:#8f3319;
      font-size:16px;
      font-family: sans-serif;
  }
  td
  {
      text-align: left;
      border: 1px solid #ddd;
      font-family: sans-serif;
  }

  tr:nth-child(even) {
      background-color: #fde0d7;
  }
  .bg-danger1
  {
      background-color: #8f3319;
      color:white;
  }
  .content-wrapper{
      padding-top:50px;
  }
  .nav-link{
      color:black;
      font-size:14px;
  }
  h3{
    font-size:20px;
}
.info-box-text{
    font-size:14px;
    
}
th{
  font-size:14px;  
}
td{
    font-size:14px;
}
.badge{
    font-size:14px;
    
}
.link1 {
    color: white;
    height: 100px;
    background-color: #874479;
    padding: 40px;
    text-decoration: none;
}
.title-head{
  font-weight: bold;
  color: #8f3319;
  font-size: 17px;
}
.example::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.example {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
  display: none;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}




</style>

</head>
<body class="hold-transition layout-fixed" style="background-color:#ffffb7; ">
    <div class="wrapper">
        @include('layouts.header')
        @yield('content')
    </div>

       
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script> $.widget.bridge('uibutton', $.ui.button); </script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/time-picker-bootstrap/timepicker.css')}}">
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    


    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>


</body>
</html>
