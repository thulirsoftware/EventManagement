
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Blackstone') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" />
  <Style>
    .field-icon {
    float: right;
    margin-left: -15px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
}
.fa {
    display: inline-block;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.red,.orange,.green,.blue .fa
{
  font-size: 30px;
}
.red .fa
{ color: #FA2A02; }
.orange .fa
{ color: #FFB402; }
.green .fa
{ color: #19BC9C; }
.blue .fa
{ color: #21A7F0; }

.panel-primary {
    border-color: #19BC9C;
}
.panel-primary>.panel-heading {
    color: #fff;
    background-color: #19BC9C;
    border-color: #19BC9C;
}
.panel-primary .panel-body th
{ color: red; }
.fa-pencil-square-o
{ color: #0662FE; }
.fa-trash-o
{ color: red; }
.red .panel-primary,.red .panel-primary .panel-heading
{
  background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #FA2A02;
}
.orange .panel-primary,.orange .panel-primary .panel-heading
{
background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #FFB402;
}
.green .panel-primary,.green .panel-primary .panel-heading
{
  background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #19BC9C;
}
.blue .panel-primary,.blue .panel-primary .panel-heading
{
 background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #21A7F0;
}
.flex-wrapper {
  display: flex;
  min-height: 100vh;
  flex-direction: column;
  justify-content: space-between;
}
.select2-selection__choice{
    background-color: #3c8dbc !important;
    border:#3c8dbc !important;
     color: #ffffff !important;
    font-weight:bold !important;
}
.select2-selection__choice__remove{
    border: none!important;
    border-radius: 0!important;
    padding: 0 2px!important;
    background-color: transparent!important;
    color: #ffffff !important;
}

.select2-selection__choice__remove:hover{
    background-color: transparent!important;
    color: #ffffff !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.panel >.card-header{
   border-top-style: solid;
  border-top-color: #00a65a;

}
.btn-primary{
  background-color: #4267B2;
  border:1px solid #4267B2;
}
.btn-primary:hover{
  background-color: #4267B2;
  border:1px solid #4267B2;
}
.separator {
  display: flex;
  align-items: center;
  text-align: center;
}

.separator::before,
.separator::after {
  content: '';
  flex: 1;
  border-bottom: 1px solid rgba(0,0,0,.1);
}

.separator:not(:empty)::before {
  margin-right: .25em;
}

.separator:not(:empty)::after {
  margin-left: .25em;
}
  h4{ font-size: 18px; }
  h3{ font-size: 20px ; font-weight: bolder;}
  body{ font-family: "Source Sans Pro", serif; }
  .layout-fixed .main-sidebar{ background-color: #1f5387; }
  .nav-sidebar .nav-item > .nav-link { color: #fff; }
  .card-cols{ margin-top: -15px; margin-bottom: 15px; }
  .main-footer{ margin-left: 0px; }
.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
    background-color: white;
    color: #1f5387;
}
.button1 {
  background-color: #1f5387;
  color: #ffffff;
  border: none;
  padding: 7px 90px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
  border-radius: 5px;
}

.button1:hover {
  opacity: 0.8;
}


.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 40%;
  border:3px solid white;
}
.info{
    color: white;
    font-weight: bold;
    text-align: center;
}

  </Style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper flex-wrapper">
      <div >
      @include('layouts.sidebar')
      @yield('content')
    </div>
    <div>
      @include('layouts.footer')
      <aside class="control-sidebar control-sidebar-dark">
      </aside>
    </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script> $.widget.bridge('uibutton', $.ui.button); </script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

        <!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote();
     var x = localStorage.getItem("Emails"); 
     var nameArr = x.split(',');
    $exampleMulti = $('.select2').select2();
    $exampleMulti.val(nameArr);
    //Flat red color scheme for iCheck
    
  });
  $('#phoneNo').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
 $('#mobile').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
 $('#zipcodes').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
  $('#EditphoneNo').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
</script>

<script>
    $(function () {

      $("#user_membership_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
       

      });
        $("#family_members_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
      
      });
     
}); 
  </script>
      <script type="text/javascript">
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
    </script>
<style>
div#example1_filter {
    float: right;
}
div#example11_filter {
    float: right;
}
div#example1_paginate {
    float: right;
}
div#example11_paginate {
    float: right;
}

.add-button {
    text-align: right;
}

.form-check {
    padding-left: 2.25rem !important;
}

.table
{
word-wrap: break-word;
word-break: break-all;  
white-space: normal !important;
text-align: justify;
}

input[type="time"]::-webkit-calendar-picker-indicator {
    background: none;
}
.without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 a.buttons-collection {
        margin-left: 1em;
        color:red;
    }
  </style>
  </body>
</html>
